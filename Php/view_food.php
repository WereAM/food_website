<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VIEW FOOD</title>
	<link rel="stylesheet" type="text/css" href="../Css/gallery.css">
</head>
<body>
	<table>
		<tr>
			<th>Id</th>
			<th>Food</th>
			<th>Image</th>
			<th>Price</th>
			<th>Edit</th>
		</tr>

		<?php
		require("connect.php");
		?>

		<?php
		$sql = "SELECT * FROM food_details";
		$results = $conn-> query($sql);
		?>

		<?php
			while ($row = $results->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $row['Id']; ?></td>
					<td><?php echo $row['Food_name']; ?></td>
					<td><img src="Assets/<?php echo $row['Image_path']; ?>" width="100" height="100"></td>
					<td><?php echo $row['Price']; ?></td>
					<td>
						<a href="edit_food.php?edit= <?php echo $row['Id']; ?>" class = "edit_btn" >Edit</a>
					</td>				
				</tr>
		<?php
		}
		?>
	</table>

</body>
</html>