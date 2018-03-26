<?php

function connect_db(){
    $host = "127.0.0.1";
    $userName = "test";
    $password = "test";
    $database = "sl_promotions";
    $mysqli = new mysqli($host, $userName, $password, $database); 
    if ($mysqli->connect_errno) {        
        echo "Error: ";        
        exit;
    }else{
        return $mysqli;
    }
    
}
