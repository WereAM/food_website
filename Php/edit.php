<?php

include "connect.php";

$client_ID = $_GET['edit'];

$qry = mysqli_query($conn, "SELECT * FROM Clients WHERE client_ID = '$client_ID'");

$data = mysqli_fetch_array($qry); //fetch data

if (isset($_POST['update'])) {
	$client_ID = $_POST['client_ID'];
	$userType = $_POST['usertype'];
	$firstname = $_POST['fname'];
	$secondname = $_POST['sname'];
	$Email = $_POST['mail'];
	$PhoneNumber = $_POST['phone'];
	$UserName = $_POST['user'];
	$Password = $_POST['password'];

	$edit = mysqli_query($conn, "UPDATE Clients SET userType = '$userType', firstname = '$firstname', secondname = '$secondname', Email = '$Email', PhoneNumber = '$PhoneNumber', UserName = '$UserName', Password = '$Password' WHERE client_ID = '$client_ID'");

	if ($edit) {
		mysqli_close($conn);
		header("location: display.php");
		exit;
	}
	else{
		echo "Error updating data";
	}
}
?>

<link rel="stylesheet" type="text/css" href="../Css/login.css">	
<div class="main">
		<div class="form-page">
			<img src="../Images/avatar.jpg" class="logo" alt="">
			<h2>UPDATE USER DATA</h2>
			<form  method= "POST" class="form">
				<div class="elements">
					<label for="userType">User Type:</label>
					<select id = "usertype" name="usertype">
						<option value="admin">ADMINISTRATOR</option>
						<option value="client">CLIENT</option>
						<option value="staff">STAFF</option>						
					</select>
				</div>
				<div class="elements">
					<label for="firstname">First Name:</label>
					<input type="text" name="fname" value="<?php echo $data['firstname']?>">
				</div>
				<div class="elements">
					<label for="secondname">Second Name:</label>
					<input type="text" name="sname" value="<?php echo $data['secondname']?>">
				</div>
				<div class="elements">
					<label for="Email">Email Address:</label>
					<input type="email" name="mail" value="<?php echo $data['Email']?>">
				</div>
				<div class="elements">
					<label for="Phone">Phone Number:</label>
					<input type="text" name="phone" value="<?php echo $data['PhoneNumber']?>">
				</div>
				<div class="elements">
					<label for="Username">Username:</label>
					<input type="text" name="user" value="<?php echo $data['UserName']?>">
				</div>
				<div class="elements">
					<label for="Password">Password:</label>
					<input type="password" name="password" value="<?php echo $data['Password']?>">
				</div>
				<div class="elements">
					<button type="submit">Update</button>
				</div>
			</form>
		</div>
	</div>