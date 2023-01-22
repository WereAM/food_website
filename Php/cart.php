<?php
session_start();
require("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ORDER DETAILS</title>
    <link rel="stylesheet" type="text/css" href="../Css/dashboard.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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


	<br/>
	<div class="container" style="width:800px;">
		<?php
		if(isset($_POST["place_order"]))  
        {  
            $insert_order = "  
            INSERT INTO orders(client_ID, Date_Ordered, order_status) VALUES ('".$client_ID."', '".date('Y-m-d')."', 'pending')";  
            $Order_ID = "";  
            if(mysqli_query($conn, $insert_order))  
            {
            	$Order_ID = mysqli_insert_id($conn);
        	}  
            $_SESSION["Order_ID"] = $Order_ID;  
            $order_details = " ";  
            foreach($_SESSION["shopping_cart"] as $keys => $values)  
            {  
                $order_details .= "  
                INSERT INTO order_details(Order_ID, Food_name, Quantity, Price) VALUES('".$Order_ID."', '".$values["item_name"]."', '".$values["item_quantity"]."', '".$values["item_price"]."');";  
            }  
            if(mysqli_multi_query($conn, $order_details))
            {  
                unset($_SESSION["shopping_cart"]);  
                echo '<script>alert("You have successfully placed an order")</script>';  
                echo '<script>window.location.href="cart.php"</script>';  
            }  
        }  
        if(isset($_SESSION["Order_ID"]))  
        {  
            $client_details = '';  
            $order_details = '';  
            $total = 0;  
            $query = '  
            SELECT * FROM orders  
            INNER JOIN order_details  
            ON order_details.Order_ID = orders.Order_ID  
            INNER JOIN clients  
            ON clients.client_ID = orders.client_ID  
            WHERE orders.Order_ID = "'.$_SESSION["Order_ID"].'"  
            ';  
            $result = mysqli_query($conn, $query);  
            while($row = mysqli_fetch_array($result))  
            {  
                $client_details = '  
                <label>'.$row["firstname"].' '.$row["secondname"].'</label>  
                <p>'.$row["Email"].'</p>  
                <p>'.$row["PhoneNumber"].'</p>  
                <p>'.$row["UserName"].'</p>  
                ';  
                $order_details .= "  
		            <tr>  
                        <td>".$row["Food_name"]."</td>  
                        <td>".$row["Quantity"]."</td>  
                        <td>".$row["Price"]."</td>  
                        <td>".number_format($row["Quantity"] * $row["Price"], 2)."</td>  
                    </tr>  
                ";  
                $total = $total + ($row["Quantity"] * $row["Price"]);  
            }  
            echo '  
            <h3 align="center">Order Summary for Order No.'.$_SESSION["Order_ID"].'</h3>  
            <div class="table-responsive">  
                 <table class="table">  
                        <tr>  
                            <td><label>Client Details</label></td>  
                        </tr>  
                        <tr>  
                            <td>'.$client_details.'</td>  
                        </tr>  
                        <tr>  
                            <td><label>Order Details</label></td>  
                        </tr>  
                        <tr>  
                            <td>  
                                <table class="table table-bordered">  
                                    <tr>  
                                        <th width="50%">Product Name</th>  
                                        <th width="15%">Quantity</th>  
                                        <th width="15%">Price</th>  
                                        <th width="20%">Total</th>  
                                    </tr>  
                                    '.$order_details.'  
                                    <tr>  
                                        <td colspan="3" align="right"><label>Total</label></td>  
                                        <td>'.number_format($total, 2).'</td>  
                                    </tr>  
                                </table>  
                            </td>  
                        </tr>  
                    </table>  
                </div>  
	            ';  
            }  
		?>		
	</div>
</body>
</html>