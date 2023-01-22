<?php
session_start();
require ("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SHOPPING CART</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
</head>
<body>
	<br/>
	<div class="container" style="width: 800px;">
		<h3 align="center"> SHOP WITH US HERE!</h3>
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#products">PRODUCTS</a></li>
			<li><a data-toggle="tab" href="#cart">CART <span class="badge"><?php if (isset($_SESSION['shopping_cart']))
			{
				echo count($_SESSION['shopping_cart']);
			}
			else
			{
				echo '0';
			}	
			?></span></a></li>
		</ul>

		<div class="tab-content">
			<div id="products" class="tab-pane fade in active">
				<?php
				$query = "SELECT * FROM food_details ORDER BY Id ASC";
				$result = mysqli_query($conn, $query);
				while($row = mysqli_fetch_array($result))
				{
				?>
				<div class="col-md-4" style="margin-top: 12px;">
					<div style="border: 1 px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" align="center">
						<img src="Assets/<?php echo $row['Image_path']; ?>" class = "img-responsive" /><br/>
						<h4 class="text-info"><?php echo $row['Food_name'];?></h4>
						<h4 class="text-danger">Kshs <?php echo $row['Price'];?></h4>
						<input type="text" name="quantity" id="quantity<?php echo $row['Id']; ?>" class="form-control" value = "1" />
						<input type="hidden" name="hidden_name" id="name<?php echo $row['Food_name'];?>" value="<?php echo $row['Food_name']; ?>" />
						<input type="hidden" name="hidden_price" id="price<?php echo $row['Price'];?>" value="<?php echo $row['Price']; ?>" />
						<input type="button" name="add_to_cart" style="margin-top:5px;" class= "btn btn-success form-control add_to_cart" value="Add to Cart" />
					</div>
				</div>
				<?php
				} 
				?>
			</div>

			<div id="cart" class="tab-pane fade">
				<div class="table-responsive" id="order_table">
					<table class="table table-bordered">
						<tr>
							<th width="40%">Item Name</th>
							<th width="10%">Quantity</th>
							<th width="20%">Price</th>
							<th width="15%">Total</th>
							<th width="10%">Action</th>
						</tr>

						<?php
						if (!empty($_SESSION['shopping_cart']))
						{
							$total = 0;
							foreach($_SESSION['shopping_cart'] as $keys => $values)
							{
						?>
						<tr>
							<td><?php echo $values['product_name']; ?></td>
							<td><?php echo $values['product_quantity']; ?></td>
							<td>Kshs <?php echo $values['product_price']; ?></td>
							<td>Kshs <?php echo number_format($values['product_quantity'] * $values['product_price'], 2); ?></td>
							<td><a href="shopping_cart.php?action=delete&Id=<?php echo $values['product_Id']; ?>"><span class="text-danger">Remove from Cart</span></a></td>                                          
						</tr>

						<?php
								$total = $total + ($values["product_quantity"] * $values["product_price"]);
							}
						?>

						<tr>
							<td colspan="3" align="right">Total></td>
							<td align="right">Kshs <?php echo number_format($total, 2); ?></td> 
						</tr>
						<tr>
							<td colspan="5" align="center">  
                                <form method="post" action="cart.php">  
                                	<input type="submit" name="place_order" class="btn btn-warning" value="Place Order" />  
                                </form>  
                            </td>
						</tr>
						<?php
						}
						?>					
					</table>
				</div>
			</div>
		</div>
	</div>

</body>
</html>

<script>
	$($document).ready(function(data)
	 {
		$('.add_to_cart').click(function()
		{
			var product_id = $(this).attr("id");
			var product_name = $('#name'+product_id).val();
			var product_price = $('#price'+product_id).val();
			var product_quantity = $('#quantity'+product_id).val();
			var action = "add";
			if (product_quantity > 0)
			{
				$.ajax({
					url:"action.php",
					method:"POST",
					dataType:"json"
					data:{
						product_id : product_id,
						Food_name : product_name,
						product_price : product_price,
						product_quantity : product_quantity,
						action : action
					},
					success:function(data)
					{
						$('#order_table').html(data.order_table);
						$('.badge').text(data.cart_item);
						alert("Product has been Added to Cart");
					}
				});
			}
			else
			{
				alert("Please Enter Quantity of Products")
			}
		});
		$(document).on('click', '.delete', function()
		{
			var product_id = $(this).attr('id');
			var action = "remove";
			if (confirm("Are you sure you want to remove this product?"))
			{
				$.ajax(
				{
					url: "action.php";
					method:"POST";
					dataType: "json";
					data:{
						product_id : product_id, 
						action : action
					},  
                     success:function(data)
                     {  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);
                      }
				});
			}
			else
			{
				return false;
			}
		});

		$(document).on('keyup', '.quantity', function()
		{
			var product_id = $(this).data("product_id");
			var quantity = $(this).val();  
            var action = "quantity_change";  
            if(quantity != '')
            {
            	$.ajax(
            	{  
                     url :"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{
                     	product_id:product_id, 
                     	quantity:quantity,
                     	action:action
                },  
                     success:function(data)
                     {  
                          $('#order_table').html(data.order_table); 
                     }
            });
        }
	});
});
</script>