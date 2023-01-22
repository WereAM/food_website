<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>REGISTER</title>
<link rel="stylesheet" type="text/css" href="../Css/login.css">
</head>
<body>
	<div class="main">
		<div class="form-page">
			<img src="../Images/avatar.jpg" class="logo" alt="">
			<h2>CREATE NEW ACCOUNT</h2>
			<form  method= "post" action="query.php" class="form">
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
					<input type="text" name="fname" id="firstname">
				</div>
				<div class="elements">
					<label for="secondname">Second Name:</label>
					<input type="text" name="sname" id="secondname">
				</div>
				<div class="elements">
					<label for="Email">Email Address:</label>
					<input type="email" name="mail" id="Email">
				</div>
				<div class="elements">
					<label for="Phone">Phone Number:</label>
					<input type="text" name="phone" id="Phone">
				</div>
				<div class="elements">
					<label for="Username">Username:</label>
					<input type="text" name="user" id="Username">
				</div>
				<div class="elements">
					<label for="Password">Password:</label>
					<input type="password" name="password" id="Password">
				</div>
				<div class="elements">
					<label for="password">Confirm Password:</label>
					<input type="password" id="password" name="Confirm Password">
				</div>
				<div class="elements">
					<button type="submit">Sign Up</button>
				</div>
				<div class="elements">
					<a href="login.php" class="register">Sign In</a>
				</div>
			</form>
		</div>
	</div>

</body>
</html>
