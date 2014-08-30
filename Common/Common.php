<?php

/*

PHP on server has parse ini blocked, revisit

function getIrishStores()
{
	$irishStoresFile = "IrishStores.data";
	
	$irishStoresArray = parse_ini_file($irishStoresFile);
	//print_r($irishStoresArray);
	return $irishStoresArray;
	
}


function getNIStores()
{
	$niStoresFile = "NIStores.data";
	
	$niStoresFile = parse_ini_file($niStoresFile);
	//print_r($niStoresFile);
	return $niStoresFile;
	
}
*/

function writeToDataFile($fileName, $productId, $searchType)
{
	
	$infoFile = fopen($fileName,"a+");
	fputcsv ($infoFile , array($productId, time(), $searchType), ',');
	fclose ($infoFile);
}

function validateProductId($productId)
{
	//first lets strip the "/" out
	$productId = str_replace ('/', "", $productId);
	
	//lets strip spaces out
	$productId = str_replace (' ', "", $productId);

	//TODO Validate characters and length(7?).
	
	return $productId;
}

function getIrishStores()
{
	$stores = array(
					"Dublin - Jervis Street" => "I008",
					"Dublin - Blanchardstown" => "I006",
					"Dublin - Fonthill Road" => "I004",
					"Dublin - Tallaght" => "I009",
					"Dublin - Swords" => "I005",
					"Dublin - Carrickmines" => "I015",
					"Cork - Maylor St." => "I007",
					"Cork - Kinsale Road" => "I017",
					"Limerick - Childers Rd" => "I011",
					"Limerick - Ennis Road" => "I029",
					"Galway - Headford Road" => "I001",
					"Kerry - Tralee" => "I012",
					"Kildare - Naas" => "I013",
					"Louth - Dundalk" => "I010",
					"Louth - Drogheda" => "I016",
					"Mayo - Claremorris" => "I019",
					"Meath - Navan" => "I030",
					"Sligo - Sligo Retail Park" => "I014",
					"Waterford - Cork Road" => "I018",
					"Westmeath - Athlone" => "I024",
					"Wicklow - Bray" => "I003",
					"Donegal - Letterkenny" => "I031",
					"On-Line - Smyths.ie" => "EI01"
					);
					
	return $stores;
}

function loadIrishStores()
{
	
}

function getNIStores()
{
}

?>