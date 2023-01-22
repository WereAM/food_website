<?php
//CONNECTING TO MYSQL

//Create a connection
$conn = new mysqli("localhost", "MichelleWere", "April(#1404)", "plant_based"); //host,username,password

//Check connection
if ($conn->connect_error) {
	die("Not Connected".$conn->connect_error);
}
else{
	//echo "Connected Successfully<br>";
}

?>