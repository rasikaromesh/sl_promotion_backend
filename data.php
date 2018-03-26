<?php
require "db_connection.php";

function get_price($name)
{
	$products = [
		"book"=>20,
		"pen"=>10,
		"pencil"=>5
	];
	
	foreach($products as $product=>$price)
	{
		if($product==$name)
		{
			return $price;
			break;
		}
	}
}

function get_today_promotions(){

    $conn = connect_db();

	$query = "SELECT * FROM promotions WHERE promotions.expire_date = '".date("Y-m-d")."'";
	
	if (!$result = $conn->query($query)) {
		response(500, "Error getting data.", null);
		exit;
	}

	if ($result->num_rows === 0) {
		response(404, "Not found.", null);
		exit;
	}

	while ($actor = $result->fetch_assoc()) {
		$fin_response["promotions"] [] =$actor;
	}

	response(200,"Ok",$fin_response);    
}