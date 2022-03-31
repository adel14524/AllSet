<?php 
	session_start();
  include_once 'dbConn.php';
  include_once 'top-nav.php';

  if (isset($_GET['action'])) {

  	if($_GET['action'] == 'shop'){
  		$_SESSION['restaurant'] = $_GET['id'];
  	}

  	if($_GET['action'] == 'add'){
	  	if (isset($_SESSION['cart_food'])) {
	  		$item_array_id = array_column($_SESSION['cart_food'], 'food_id');
	  		if (!in_array($_GET['id'], $item_array_id)) {
	  			$count = count($_SESSION['cart_food']);
	  			$item_array = array(
	  				'food_id' => $_GET['id'],
	  				'food_name' => $_POST['food_name'],
	  				'food_price' => $_POST['food_price'],
	  				'quantity' => $_POST['quantity'],
	  			);

	  			$_SESSION['cart_food'][$count] = $item_array;
	  			echo '<script>window.location="food_menu_customer.php"</script>';
	  		}else{
	  			echo '<script>alert("Product is already Added to Cart")</script>';
	  			echo '<script>window.location="food_menu_customer.php"</script>';
	  		}
	  	}
	  	else{
			$item_array = array(
	            'food_id' => $_GET['id'],
	  			'food_name' => $_POST['food_name'],
	  			'food_price' => $_POST['food_price'],
	  			'quantity' => $_POST['quantity'],
	        );
	        $_SESSION["cart_food"][0] = $item_array;
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


</style>
<head>
	<title>Menu for you</title>
</head>
<body>
	<?php
		$owner_id = $_SESSION['restaurant'];

		$food_type = "SELECT * FROM food_type;";
		$foodtype_result = mysqli_query($conn, $food_type);

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
					<p>Reminder: make sure to click button 'Add' everytime after you insert number of the spcific food.</p>
				</div>
				<div class="cart-button mt-auto">
					<a href="cart-customer.php" type="button" class="btn btn-success"><i class="fab fa-opencart"></i>&nbsp;&nbsp; View Cart</a>
				</div>
			</div>
			
			<div class="food-list">
					<?php
						//echo $owner['restaurant_name'];
						while ($ft_record = mysqli_fetch_assoc($foodtype_result)) {

							$ft = $ft_record['food_type_id'];

							$food_menu = "SELECT * FROM food WHERE owner_id ='".$owner_id."' AND food_type_id = '".$ft."';";
							$food_result = mysqli_query($conn, $food_menu);

							if($food_result->num_rows > 0){
								echo "<table class='table'>";

								echo "<thead class='thead-dark'><tr><th scope='col' colspan='2'><h5># ".$ft_record['food_desc']."</h5></th>";
								echo "<th scope='col'><h6>Price</h6></th>";
								echo "<th scope='col'><center><h6>Action</h6></center></th></tr>";
								echo "</thead><tbody>";
								$i = 1;
								while ($fr_record = mysqli_fetch_assoc($food_result)) {

					?>		
							<tr>
								<td><?php echo $i;?></td>
								<td class="food-name"><p><?php echo $fr_record['food_name']; ?></p></td>
								<td class="food-price"><p>RM <?php echo $fr_record['food_price']; ?></p></td>
								<td class="food-action">
									<form method="post" action="food_menu_customer.php?action=add&id=<?php echo $fr_record['food_id']; ?>" > 
										<div class="input-group" action="food-menu-customer.php?action=add$id=<?php echo $fr_record['food_id'];?>">
									    	<input type="number" class="form-control" placeholder="Quantity" name="quantity">

									    	<input type="hidden" name="id" value="<?php echo $fr_record['food_id'];?>">
									    	<input type="hidden" name="food_name" value="<?php echo $fr_record['food_name'];?>">
									    	<input type="hidden" name="food_price" value="<?php echo $fr_record['food_price'];?>">

									    	<div class="input-group-append">
									    		<input type="submit" name="add" class="btn btn-outline-secondary" value="Add"></input>
									  		</div>
										</div>
									</form>
								</td>
							</tr>

					<?php
								$i++;
								}
								echo "</tbody></table>";
							}
						}
					?>
			</div>
			<div class="d-flex justify-content-end" style="margin-bottom: 10px;">
				<div class="cart-button mt-auto">
					<a href="cart-customer.php" type="button" class="btn btn-success"><i class="fab fa-opencart"></i>&nbsp;&nbsp; View Cart</a>
				</div>
			</div>
		</div>
		
	</div>


</body>
