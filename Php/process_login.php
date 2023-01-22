<?php
session_start();
require_once("connect.php");

if (isset($_POST['Login']))
{
	$UserName = $_POST['user'];
	$Password = $_POST['password'];

	$query = "SELECT * FROM Clients WHERE UserName = '$UserName' AND Password = '$Password'";
	$qry = mysqli_query($conn, $query);
	$usertypes = mysqli_fetch_array($qry);

	if ($usertypes ['userType'] == "admin")
	{
		$_SESSION['User'] = $UserName;
		header("location: admin_panel.php");
	}
	elseif ($usertypes ['userType'] == "client")
	{
		$_SESSION['User'] = $UserName;
		header("location: dashboard.php");
	}
	else
	{
		$_SESSION['status'] = "UserName / Password is Invalid";
		header("location: login.php");
	}
}
?>