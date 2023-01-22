<?php
session_start();
require ("connect.php");

if (isset($_POST['add_to_cart']))
{
	if (isset($_SESSION['shopping_cart']))
	{
		$item_array_id = array_column($_SESSION['shopping_cart'], 'item_Id');
		if (!in_array($_GET['Id'], $item_array_id))
		{
			$count = count($_SESSION['shopping_cart']);
			$item_array = array(
				'item_Id' => $_GET['Id'],
				'item_name' => $_POST['hidden_name'],
				'item_price' => $_POST['hidden_price'],
				'item_quantity' => $_POST['quantity']
			);
			$_SESSION['shopping_cart'][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
			echo '<script>window.location = "shopping_cart.php"</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_Id' => $_GET['Id'],
			'item_name' => $_POST['hidden_name'],
			'item_price' => $_POST['hidden_price'],
			'item_quantity' => $_POST['quantity']
		);
		$_SESSION['shopping_cart'][0] = $item_array;
	}
}
if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_Id"] == $_GET["Id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="shopping_cart.php"</script>';  
                }  
           }  
      }  
 }  
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SHOPPING CART</title>
	<link rel="stylesheet" type="text/css" href="../Css/dashboard.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrap.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="logo">
		<img src="../Images/plant logo.jpg">
	</div>

	<nav>
		<ul>
			<li><a href="dashboard.php">GALLERY</a></li>
			<li class="active"><a href="shopping_cart.php">ORDER</a></li>
			<li><a href="../Html/cereals.html">HOME</a></li>
			<li><a href="logout.php">LOG OUT</a></li>
			<li><img src="../Images/avatar.jpg" class="user" alt=""></li>
			<li><?php echo $_SESSION['User'];?></li>

		</ul>
	</nav>
	<br/>

	<div class="container" style="width: 700px;">
		<h3 align="center">SHOP WITH US HERE!!</h3><br/>

		<?php
		$query = "SELECT * FROM food_details ORDER BY Id ASC";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0)
		{
			while ($row = mysqli_fetch_array($result))
			{
		?>

		<div class="col-md-4">
			<form method="post" action="shopping_cart.php?action=add&Id=<?php echo $row['Id']; ?>">
				<div style="border: 1px solid #333; background-color: #f1f1f1; border-radius: 5px; padding: 16px;" align="center">
					<img src="Assets/<?php echo $row['Image_path']; ?>" class ="img-responsive" /><br/>
					<h4 class="text-info"><?php echo $row['Food_name']; ?></h4>
					<h4 class="text-danger">Kshs <?php echo $row['Price']; ?></h4>
					<input type="text" name="quantity" class="form-control" value="1">
					<input type="hidden" name="hidden_name" value="<?php echo $row['Food_name']; ?>"/>
					<input type="hidden" name="hidden_price" value="<?php echo $row['Price']; ?>"/>
					<input type="submit" name="add_to_cart" style="margin-top:5px"; class="btn btn-warning" value="Add to Cart" />
				</div>
			</form>
		</div>
		<?php
			}
		}
		?>

		<div style="clear:both"></div>
		<br/>
		<h3>My Order</h3>
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th width="40%">Item Name</th>
					<th width="10%">Quantity</th>
					<th width="20%">Price</th>
					<th width="15%">Total</th>
					<th width="15%">Action</th>
				</tr>
				
				<?php
				if (!empty($_SESSION['shopping_cart']))
				{
					$total = 0;
					foreach ($_SESSION['shopping_cart'] as $keys => $values)
					{
				?>
				<tr>
					<td><?php echo $values['item_name']; ?></td>
					<td><?php echo $values['item_quantity']; ?></td>
					<td>Kshs <?php echo $values['item_price']; ?></td>
					<td>Kshs <?php echo number_format($values['item_quantity'] * $values['item_price'],2); ?></td>
					<td><a href="shopping_cart.php?action=delete&Id=<?php echo $values['item_Id']; ?>"><span class="text-danger">Remove from Cart</span></a></td>
				</tr>

				<?php
						$total = $total + ($values["item_quantity"] * $values['item_price']);
					}
				?>
				<tr>
					<td colspan="3" align="right">Total</td>
					<td align="right">Kshs <?php echo number_format($total, 2); ?></td>
				</tr>
				<?php
				}
				?>
				<tr>  
                    <td colspan="5" align="center">  
                        <form method="post" action="cart.php">  
                        	<input type="submit" name="place_order" class="btn btn-danger" value="Place Order" />  
                        </form>  
                    </td>  
                </tr> 
			</table>
		</div>
	</div>
	<br/>
</body>
</html>