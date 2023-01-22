<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>WELCOME</title>
	<link rel="stylesheet" type="text/css" href="../Css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../Css/gallery.css">
</head>
<body>

	<div class="logo">
		<img src="../Images/plant logo.jpg">
	</div>

	<nav>
		<ul>
			<li class="active"><a href="">GALLERY</a></li>
			<li><a href="shopping_cart.php">ORDER</a></li>
			<li><a href="../Html/cereals.html">HOME</a></li>
			<li><a href="logout.php">LOG OUT</a></li>
			<li><img src="../Images/avatar.jpg" class="user" alt=""></li>
			<li><?php echo $_SESSION['User'];?></li>

		</ul>
	</nav>

	<table>
		<tr>
			<th>Id</th>
			<th>Food</th>
			<th>Image</th>
			<th>Price</th>
			
		</tr>

		<?php
		require("connect.php");
		?>

		<?php
		$sql = "SELECT * FROM food_details";
		$results = $conn-> query($sql);
		?>

		<?php
			while ($row = $results->fetch_assoc()){ ?>
				<tr>
					<td><?php echo $row['Id']; ?></td>
					<td><?php echo $row['Food_name']; ?></td>
					<td><img src="Assets/<?php echo $row['Image_path']; ?>" width="100" height="100"></td>
					<td><?php echo $row['Price']; ?></td>
									
				</tr>
		<?php 
		}
		?>
	</table>	

</body>
</html>