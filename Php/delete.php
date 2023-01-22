<?php

include "connect.php";

$client_ID = $_GET['delete'];

$del = mysqli_query($conn, "DELETE from Clients WHERE client_ID = '$client_ID'");

if ($del) {
	mysqli_close($conn);
	header("location:display.php");
	exit;
}
else{
	echo"Error deleting record";
}
?>