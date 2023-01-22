<?php
session_start();
require("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VIEW ORDERS</title>
	<link rel="stylesheet" type="text/css" href="../Css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../Css/view_orders.css">
		
</head>
<body>

	<div class="logo">
		<img src="../Images/plant logo.jpg">
	</div>

	<nav>
		<ul>
			<li><a href="../Html/cereals.html">HOME</a></li>
			<li><a href="display.php">VIEW USERS</a></li>
			<li><a href="upload_image.php">ADD FOOD</a></li>
			<li><a href="edit_food.php">EDIT FOOD</a></li>
			<li class="active"><a href="view_orders.php">VIEW ORDERS</a></li>
			<li><a href="logout.php">LOG OUT</a></li>
			<li><img src="../Images/avatar.jpg" class="user" alt=""></li>
			<li><?php echo $_SESSION['User'];?></li>

		</ul>
	</nav>
	<br>
	<table>
		<tr>
			<th>Order_No</th>
			<th>Order_ID</th>
			<th>Food_name</th>
			<th>Quantity</th>
			<th>Price</th>
		</tr>

		<?php
		require("connect.php");
		?>

		<?php
		$sql = "SELECT * FROM order_details";
		$results = $conn-> query($sql);
		?>
		
		<?php
			while ($row = $results->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $row['Order_No']; ?></td>
					<td><?php echo $row['Order_ID']; ?></td>
					<td><?php echo $row['Food_name']; ?></td>
					<td><?php echo $row['Quantity']; ?></td>
					<td><?php echo $row['Price']; ?></td>			
				</tr>
		<?php } ?>
	</table>
</body>
</html>
