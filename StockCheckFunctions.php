<?php

function displayItemInfo($productId)
{
	$infoFileName = "data.csv";

	$productUrl = getProductUrl($productId);
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
						<a href="'.$productUrl.'">Buy '.$productTitle.' at Toys.ie - &euro;'.$productPrice.'</a>
					</td>
					<td align="center">
						<img src="'.$productImage.'" alt="'.$productTitle.'" />
					</td>
				</tr>
			</table>';
			
	echo "<br /><br />";
	
	return true;
	
}

function getProductHtmlCode($productUrl)
{
	return file_get_contents("$productUrl");
}

function getProductUrl($productId)
{


	$productUrl = "http://www.toys.ie/-!".$productId."-prd.aspx";
	return $productUrl;
}

function doesProductExist($productPage)
{
	$pos = strpos($productPage, "Sorry, this product is currently unavailable.");
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
	$tempArray = explode (" – Top Toy Store in UK & Ireland, Games & Toys Online from Smyths Superstores", $productPageTitle);
	$productName = $tempArray[0];
	return $productName;
}


function get_page_title($data)
{

	// Get <title> line
	preg_match ("/<title>([^`]*?)<\/title>/", $data, $match);
	return $match[1];


}

function get_product_price($data)
{
	// Get price
	//preg_match ("/<h2>.{1}([^<]*)</", $data, $match);
	//preg_match ("/<h2>\D*([0-9]*\.{1}[0-9]{0,2})</", $data, $match);
	preg_match ("/<td>\D*([0-9]*\.{1}[0-9]{0,2})<\/td>/", $data, $match);
	return $match[1];

}

function get_product_image($productId)
{
	// Get Image
	
	return "http://smythstoys.static.s3-website-eu-west-1.amazonaws.com/product_images/".$productId."_M.jpg";
}

?>