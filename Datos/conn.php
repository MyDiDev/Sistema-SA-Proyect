<?php

$username = "root";
$pwd = "";
$server = "localhost";
$db = "sistemasa";

try{
 $conn = mysqli_connect($server, $username, $pwd, $db);   
}catch(Exception $ex){
    throw $ex;
}

?>