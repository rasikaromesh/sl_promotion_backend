<?php
header("Content-Type:application/json");
require "data.php";

if(empty($_GET['query'])){
	$query=NULL;
}else{
	$query=$_GET['query'];
}

// if(empty($query)){
	get_promotions($_GET['query']);
// }else if($query == "week" ){

// }


function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);
	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data;
	
	$json_response = json_encode($response);
	echo $json_response;
}