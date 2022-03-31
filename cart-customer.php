<?php
	session_start();
	
	include_once 'dbConn.php';
  	include_once 'top-nav.php';

  	if (isset($_GET['action'])){
	  	if ($_GET['action'] == "delete"){
	  		foreach ($_SESSION['cart_food'] as $keys => $value){
	  			if ($value['food_id'] == $_GET["id"]){
	                unset($_SESSION['cart_food'][$keys]);
	                echo '<script>alert("PRODUCT HAS BEEN REMOVED FROM YOUR SHOPPING CHART")</script>';
	                echo '<script>window.location="cart-customer.php"</script>';
	            }
	  		}
	  	}
	  }
?>  
<style type="text/css">
	.main-box{
		border: 1px transparent;
		width: 80%;
		min-height: 200px;
		margin-top: 20px;
		padding: 20px 0px 0px 20px;
	}

	.food-name{
		width: 40%;
	}

	.food-action{
		width: 20%;
	}

	.btn-confirm{
		box-shadow: 0px 0px 7px darkgray;
	}

	.btn-confirm:hover{
		box-shadow: 0px 0px 7px lightgray;
	}


</style>
<head>
	<title>ORDER CART</title>
</head>
<body>

	<?php
		$owner_id = $_SESSION['restaurant'];

		$owner_rest = "SELECT * FROM restaurant_owner WHERE owner_id ='".$owner_id."';";
		$owner_result = mysqli_query($conn, $owner_rest);
	?>

	<div class="d-flex justify-content-center">
		<div class="main-box">
			<div class="d-flex justify-content-between top-menu" style="margin-bottom: 10px;">
				<div class="rest-name">
					<h2><span>
						<?php  
							while ($owner = mysqli_fetch_assoc($owner_result)) {
								echo $owner['restaurant_name'];
							}
						?>					
					</span></h2>
					<p>Reminder: You may click 'Delete' button for food that you want to remove.</p>
				</div>
				<div class="rest-button mt-auto">
					<a href="food_menu_customer.php?action=shop&id=<?php echo $owner_id; ?>" type="button" class="btn btn-success"><i class="fas fa-store"></i>&nbsp;&nbsp; Return to the Restaurant</a>
				</div>
			</div>
			
			<div class="food-list">
				<?php  
					if(!empty($_SESSION['cart_food'])){
						$i = 1;
						$total_price = 0;

				?>

				<table class='table'>
					<thead class='thead-dark'>
						<tr>
							<th scope='col' colspan='2'><h5># FOOD AND DRINK</h5></th>
							<th scope='col' style="width: 10%"><center><h6>Price (Unit)</h6></center></th>
							<th scope='col'><center><h6>Quantity</h6></center></th>
							<th scope='col' style="width: 10%"><center><h6>Total (RM)</h6></center></th>
							<th scope='col'><center><h6>Action</h6></center></th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($_SESSION['cart_food'] as $key => $value){
							$total_fp = $value['quantity'] * $value['food_price'];
					?>
						<tr>
							<td>
								<center><p><?php echo $i;?></p></center>
							</td>
							<td>
								<p><?php echo $value['food_name']; ?></p>
							</td>
							<td>
								<div style="text-align: right;"><p><?php echo $value['food_price']; ?></p></div>
							</td>
							<td>
								<center><p><?php echo $value['quantity']; ?></p></center>
							</td>
							<td>
								<div style="text-align: right;"><p><?php echo number_format($total_fp, 2, '.', ''); ?></p></div>
							</td>
							<td>
								<div class="mt-auto"><center>
									<a href="cart-customer.php?action=delete&id=<?php echo $value['food_id']; ?>" type="button" class="btn btn-danger">
										<i class="far fa-trash-alt"></i>&nbsp;&nbsp; Delete 
									</a></center>
								</div>
								
							</td>
						</tr>

					<?php
							$i++;
							$total_price = $total_price + $total_fp;
							$total_pay = $total_price * 1.06;
						}

					?>
						<tr>
							<td colspan="2" style="background-color: lightgray; text-align: left;" >TOTAL : RM <?php echo number_format($total_price, 2, '.', '') ;?></td>
							<td colspan="2" style="background-color: lightgray; text-align: right;" >TOTAL PAY: </td>
							<td colspan="2">RM <?php echo number_format($total_pay, 2, '.', '') ;?> (6% tax included) </td>
						</tr>
					</tbody>
				</table>

				<?php
					}else{
				?>
						<div style="margin-top: 30px;">
							<center><h4>Cart is empty.<br>Make sure to make some order from us!</h4></center>
						</div>
				<?php
					}
				?>
			</div>

			<?php
				if(!empty($_SESSION['cart_food'])){
			?>

			<form method="POST" action="display-receipt.php">
				<div class="row" style="margin-left: 20px;">
					<div class="d-flex flex-column">
						<div class="form-group row">
							<label for="example-datetime-local-input" class="col-form-label">Choose your DATE & TIME : </label>
							<div class="ml-2">
								<input class="form-control" name="date-time" type="datetime-local" value="2020-11-11T13:45:00" id="example-datetime-local-input" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-number-input" class="col-form-label">Key in Number of Person :</label>
							<div class="ml-2">
								<input class="form-control" name="qty-person" type="number" id="example-number-input">
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="total-pay" value="<?php echo $total_pay;?>">
				<div class="d-flex justify-content-end row" style="margin-bottom: 10px;">
					<div class="reserve-button mt-auto">
						<button type="submit" style="border: none; padding: 0px;"><a type="button" class="btn btn-light btn-confirm"><i class="fas fa-file-invoice"></i>&nbsp;&nbsp; Confirm Order</a></button>
					</div>
				</div>
			</form>

			<?php
				}
			?>
		</div>
		
	</div>


	
</body>