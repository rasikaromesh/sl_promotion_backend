<?php

header("Content-Type:application/json");
//require "data.php";
//require "db_connection.php";

if(!empty($_GET['name']))
{
    $name=$_GET['name'];
    if($name == "db"){
        $mysqli = connect_db();
        $sql = "SELECT * FROM promotions ";

        if (!$result = $mysqli->query($sql)) {
            // Oh no! The query failed. 
            echo "Sorry, the website is experiencing problems.";
        
            // Again, do not do this on a public site, but we'll show you how
            // to get the error information
            echo "Error: Our query failed to execute and here is why: \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit;
        }

        if ($result->num_rows === 0) {
            // Oh, no rows! Sometimes that's expected and okay, sometimes
            // it is not. You decide. In this case, maybe actor_id was too
            // large? 
            echo "We could not find a match for ID $aid, sorry about that. Please try again.";
            exit;
        }

        // $actor = $result->fetch_assoc();

        while ($actor = $result->fetch_assoc()) {
            $fin_response["promotions"] [] =$actor;
        }

        //$data = get_today_promotions();
        response(200,"good requsert",$fin_response);
    }

	
}
else
{
	response(400,"Invalid Request",NULL);
}

function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);
	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data;
	
	$json_response = json_encode($response);
	echo $json_response;
}














function connect_db(){
    $serverName = "127.0.0.1";
    $userName = "test";
    $password = "test";
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'sl_promotions'); 
    if ($mysqli->connect_errno) {        
       
        echo "Error: Failed to make a MySQL connection,\n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        
        exit;
    }else{
        return $mysqli;
    }
    
}

function test_db_connection($conn){    
    //check the connection
   // $query = "SELECT * FROM promotions";
    if($conn -> connect_error){
        return "conn faild";
        //die("Connection Faild: ".$conn -> connect_error);
    }
    return $conn;
}