<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>DISPLAY USERS</title>
	<link rel="stylesheet" type="text/css" href="../Css/display.css">	
</head>
<body>
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