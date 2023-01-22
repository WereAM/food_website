<?php

include_once("connect.php");//insert content from another php file (if it doesn't find connect.php, it brings an error but continues.)
//require_once("connect.php") -- if it doesn't find connect.php it will not continue.

//Create database
$sql = "CREATE DATABASE plant_based";

//Create table
$sql_table = "CREATE TABLE Clients(client_ID INT(6) AUTO_INCREMENT PRIMARY KEY,userType VARCHAR(20) NOT NULL, firstname VARCHAR(10) NOT NULL, secondname VARCHAR(10) NOT NULL, Email VARCHAR(25) NOT NULL, PhoneNumber INT(10) NOT NULL, UserName VARCHAR(10) NOT NULL, Password VARCHAR(10) NOT NULL)";

$userType = $_POST['usertype'];
$firstname = $_POST['fname'];
$secondname = $_POST['sname'];
$Email = $_POST['mail'];
$PhoneNumber = $_POST['phone'];
$UserName = $_POST['user'];
$Password = $_POST['password'];

//Insert table
$sql_insert = "INSERT INTO Clients(userType,firstname,secondname,Email,PhoneNumber,UserName,Password) VALUES ('$userType', '$firstname', '$secondname', '$Email', '$PhoneNumber', '$UserName', '$Password')";


if ($conn->query($sql_insert) === TRUE){
	echo "Data Inserted<br>";
}
else{
	echo "Error Inserting Data<br>".$conn->error;
}

//Select Data
//$sql_select = "SELECT * FROM Clients";

//$results = $conn->query($sql_select);
//print_r($results);
//rows=$results->fetch_assoc();

//if ($results->num_rows > 0) {
//	while ($row =$results->fetch_assoc()) {
		//echo "The First Name is ".$rows["firstname"]."<br>";
//		$rows[] = $row;
//	}
//}
//echo "<pre>";
//print_r($rows);
//echo "</pre>";


?>