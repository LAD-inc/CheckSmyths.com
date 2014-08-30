<?php

require_once('secret.php');

function displayItemInfo($productId)
{
	$infoFileName = "data.csv";

	$productCode = getProductCode($productId);
	$productUrl = getProductUrl($productCode);
	$productPage = getProductHtmlCode($productUrl);
	
	
	if (!doesProductExist($productPage))
	{
		//item does not exist!
		echo "No item found matching product ID\n";
		echo "<br />";
		
		return false;
	}
	
	$infoFile = fopen($infoFileName,"a+");
	fputcsv ($infoFile , array($productId, time()), ',');
	fclose ($infoFile);
	
	$productPageTitle = get_page_title($productPage);
	//echo "PRODUCT PAGE TITLE: ". $productPageTitle;
	
	$productTitle = getProductName($productPageTitle);
	//echo "PRODUCT TITLE: ". $productTitle;
	
	$productPrice = get_product_price($productPage);
	//echo "PRODUCT PRICE: ". $productPrice;
	
	$productImage = get_product_image($productId);
	//echo "PRODUCT IMAGE: ". $productImage;
	
	echo '	<table width="800">
				<tr>
					<td align="center" width="375">
						<a href="'.$productUrl.'">Buy '.$productTitle.' - &euro;'.$productPrice.'</a>
					</td>
					<td align="center">
						<img src="'.$productImage.'" alt="'.$productTitle.'" />
					</td>
				</tr>
			</table>';
			
	echo "<br /><br />";
	
	return true;
	
}

function getProductCode($productId)
{
	$obj = secretGetJsonStockObject($productId, "I015");
	return $obj[0] -> {'ProductId'};
}

function getProductHtmlCode($productUrl)
{	
	return file_get_contents($productUrl);
}

function getProductUrl($productCode)
{

	$productUrl = "http://www.smythstoys.com/ie/en-ie/product/".$productCode."/";
	return $productUrl;
}

function doesProductExist($productPage)
{
	$pos = strpos($productPage, "The page you are looking for cannot be found");
	if ($pos !== false)
	{
		echo "No item found matching product ID\n";
		echo "<br />";
		return false;
	}
	else
	{
		//echo "PRODUCT EXISTS";
		return true;
	}
	
}

function getProductName($productPageTitle)
{
	//$tempArray = explode (" – Top Toy Store in UK & Ireland, Games & Toys Online from Smyths Superstores", $productPageTitle);
	//$productName = $tempArray[0];
	return $productPageTitle;
}


function get_page_title($data)
{

	// Get <title> line
	preg_match ("/<title>([^`]*?)<\/title>/", $data, $match);
	//error_log (var_dump($match));
	//error_log($data);
	return $match[1];

}

function get_product_price($data)
{
	// Get price
	//preg_match ("/<h2>.{1}([^<]*)</", $data, $match);
	//preg_match ("/<h2>\D*([0-9]*\.{1}[0-9]{0,2})</", $data, $match);
	preg_match ("/<div class=\"price normal\">\D*([0-9]*\.{1}[0-9]{0,2})<\/div>/", $data, $match);
	
	if(count($match) > 1)
	{
		return $match[1];
	}
	
	//Sale Price:
	preg_match ("/<span class=\"price\">\D*([0-9]*\.{1}[0-9]{0,2})<\/price>/", $data, $match);
	

}

function get_product_image($productId)
{
	// Get Image
	//http://d1whee3s2ff61n.cloudfront.net/product/extralarge/131777.jpg
	return "http://d1whee3s2ff61n.cloudfront.net/product/large/".$productId.".jpg";
}

?>