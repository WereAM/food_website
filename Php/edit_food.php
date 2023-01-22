<?php

include "connect.php";

$Id = $_GET['edit'];

$qry = mysqli_query($conn, "SELECT * FROM food_details WHERE Id = '$Id'");

$data = mysqli_fetch_array($qry); //fetch data

if (isset($_POST['update'])) {
	$Id = $_POST['Id'];
	$Food_name = $_POST['fooditem'];
	$Image_path = $_POST['food-image'];
	$Price = $_POST['price'];

	$edit = mysqli_query($conn, "UPDATE food_details SET Food_name = '$Food_name', Image_path = '$Image_path', Price = '$Price' WHERE Id = '$Id'");

	if ($edit) {
		mysqli_close($conn);
		header("location: view_food.php");
		exit;
	}
	else{
		echo "Error updating data";
	}
}
?>

<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>EDIT FOOD</title>
	<link rel="stylesheet" type="text/css" href="../Css/upload_image.css">
</head>
<body>

	<div class="logo">
		<img src="../Images/plant logo.jpg">
	</div>

	<nav>
		<ul>
			<li><img src="../Images/avatar.jpg" class="user" alt=""></li>
			<li><?php echo $_SESSION['User'];?></li>
		</ul>
	</nav>

<div class="main">
		<div class="form-page">
			<h2>EDIT FOOD</h2>
			<form action="process_editfood.php" method= "POST" class="form">
				<div class="elements">
					<label for="fooditem">Food Name:</label><br>
					<input type="text" name="fooditem" value="<?php echo $data['Food_name']?>"><br><br>
				</div>
				<div class="elements">
					<label for="foodimage">Image:</label><br>
					<input type="file" name="food-image" id="foodimage" required="true" value="<?php echo $data['Image_path']?>"><br/><br/>
				</div>
				<div class="elements">
					<label for="foodprice">Price:</label><br>
					<input type="number" name="price" id="foodprice" required="true" value="<?php echo $data ['Price']?>"><br/><br/>
				</div>
				<div class="elements">
					<button type="submit">Update</button>
				</div>
			</form>
		</div>
	</div>