<?php

function connect(){
	$dbserver = "localhost";
	$dbuser = "MichelleWere";
	$dbpass = "April(#1404)";
	$dbname = "plant_based";
	$link = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname) or die("Could not connect");
	return $link;
}

function getData($sql){
	$link = connect();
	$result = mysql_query($link, $sql);

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$rows[] = $row;
	}
	return $rows;
}

function setData($sql){
	$link = connect();
	if (mysqli_query($link, $sql)) {
		return true;
	}
	else{
		return false;
	}
}

?>