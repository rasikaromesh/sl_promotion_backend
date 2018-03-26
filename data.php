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

function get_promotions($range){

    $conn = connect_db();

	if(empty($range)){
		$query = "SELECT * FROM promotions WHERE promotions.expire_date = '".date("Y-m-d")."'";
	}else{
		$to_date = get_date_range(get_increment($range));
		$query = "SELECT * FROM promotions WHERE promotions.expire_date BETWEEN '".date("Y-m-d")."' and '".$to_date."'";
	}
	
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


function get_increment($range){	
	if($range == "week"){
		$increments = 7-date("N");
	}elseif($range == "month"){
		$increments = date("t")-date("j");
	}
	return $increments;
}

function get_date_range($increments){
	$today = date_create(date("Y-m-d"));

	date_add($today, date_interval_create_from_date_string("".$increments."days"));
	return $today->format("Y-m-d");
}