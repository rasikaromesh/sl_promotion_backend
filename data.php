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
    $result = $conn -> query($query);
    return connect_db();
}