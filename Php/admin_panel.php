<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ADMIN PANEL</title>
	<link rel="stylesheet" type="text/css" href="../Css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../Css/display.css">	
</head>
<body>

	<div class="logo">
		<img src="../Images/plant logo.jpg">
	</div>

	<nav>
			<h1>ADMIN PANEL</h1>

		<ul>
			<li><a href="../Html/cereals.html">HOME</a></li>
			<li class="active"><a href="display.php">VIEW USERS</a></li>
			<li><a href="upload_image.php">ADD FOOD</a></li>
			<li><a href="edit_food.php">EDIT FOOD</a></li>
			<li><a href="view_orders.php">VIEW ORDERS</a></li>
			<li><a href="logout.php">LOG OUT</a></li>
			<li><img src="../Images/avatar.jpg" class="user" alt=""></li>
			<li><?php echo $_SESSION['User'];?></li>

		</ul>
	</nav>
	<br>

<table>
		<tr>
			<th>UserType</th>
			<th>client_ID</th>
			<th>firstname</th>
			<th>secondname</th>
			<th>Email</th>
			<th>PhoneNumber</th>
			<th>UserName</th>
			<th colspan="2">ACTIONS</th>
		</tr>

		<?php
		require("connect.php");
		?>

		<?php
		$sql = "SELECT userType, client_ID, firstname, secondname, Email, PhoneNumber, UserName FROM clients";
		$results = $conn-> query($sql);
		?>
		
		<?php
			while ($row = $results->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $row['userType']; ?></td>
					<td><?php echo $row['client_ID']; ?></td>
					<td><?php echo $row['firstname']; ?></td>
					<td><?php echo $row['secondname']; ?></td>
					<td><?php echo $row['Email']; ?></td>
					<td><?php echo $row['PhoneNumber']; ?></td>
					<td><?php echo $row['UserName']; ?></td>
					<td>
						<a href="edit.php?edit= <?php echo $row['client_ID']; ?>" class = "edit_btn" >Edit</a>
					</td>
					<td>
						<a href="delete.php?delete=<?php echo $row['client_ID']; ?>" class = "del_btn">Delete</a>
					</td>				
				</tr>
		<?php } ?>
	</table>
	
</body>
</html>