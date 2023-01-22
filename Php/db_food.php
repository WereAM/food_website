<?php

require_once("dbconnect.php");

function getFood(){
	$sql = "SELECT * FROM food_details";
	$data = getData($sql);
	return $data;
}

?>