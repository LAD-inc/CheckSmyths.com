
<?php

// -------------------
// --- PHP Imports ---
// -------------------
require_once('Common/Common.php');
require_once('secret.php');

function getStockStatusIreland($productCode, $storeCode)
{

	$obj = secretGetJsonStockObject($productCode, $storeCode);
	
	
	//echo $response;

	//$stockStatus = extractStockDetails ($response);
	
	//error_log (var_dump($obj));
	//error_log(strval($obj[0]->{'Stock'}));
	if(count($obj) > 0)
	{
		$stockString = strval($obj[0]->{'Stock'});
	}
	else
	{
		$stockString = "ERROR";
	}
	
	echo extractStockDetails($stockString);
	
}
			
function extractStockDetails ($stockString)
{

	// Error?
	if (strcmp($stockString, "ERROR") == 0)
	{
		$stockStatus =  'Unknown Status';
		return $stockStatus;
	}

	// No Stock?
	if (strcmp($stockString, "0") == 0)
	{
		$stockStatus =  'Out Of Stock';
		return $stockStatus;
	}
	
	$stockStatus = 'In Stock: '. $stockString;

	return $stockStatus;
}

	
	

?>
