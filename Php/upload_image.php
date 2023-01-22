<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>UPLOAD FOOD</title>
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

	<h1>Add Any New Food Here:</h1>
	<br>

	<form action="process_upload.php" method="post" enctype="multipart/form-data">
		<label for="fooditem">Food Name:</label><br>
		<input type="text" name="fooditem" required="true" placeholder="Food Item Name"/><br/><br/>

		<label for="foodimage">Image:</label><br>
		<input type="file" name="food-image" id="foodimage" required="true"><br/><br/>

		<label for="foodprice">Price:</label><br>
		<input type="number" name="price" id="foodprice" required="true"><br/><br/>

		<input type="submit" name="submitImage" value="UPLOAD">

	</form>

</body>
</html>