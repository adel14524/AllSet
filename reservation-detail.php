<?php
	session_start();
    include_once 'top-nav.php';
	include_once 'dbConn.php';
	
	$reservation_id = $_GET['resID'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Reservation Details</title>
	<style type="text/css">
		body{
			margin: 0px;
			padding: 0px;
		}
		.main-box{
			width: 100%;
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			margin-bottom: 50px;
		}

		.my-account{
			margin: 40px 30px;
			box-shadow: 0px 0px 20px darkgray;
			border-radius: 20px;
			height: 630px;
			width: 600px;
			border: 1px solid black;
		}

		.my-account-box, .details{
			display: flex;
			flex-direction: column;
			margin: 5px;
            margin-left: 30px;
		}

        .details {
			margin-top: 50px;
		}

		.title-myaccount{
			text-align: center;
			height: 55px;
			width: 400px;
		}

		.part-detail{
			margin: 10px 0px;
			display: flex;
			flex-direction: row;
		}

		.label{width: 150px; padding: 10px; }
		.data-cust{width: 300px; padding: 10px;}

		.data-cust input{
			color: black;
			font-weight: bold;
			width: 250px;
			background-color: #f2efe4;
			border: 1px transparent;
			border-radius: 10px;
			padding: 5px 7px;
		}

		.form-button{
			margin-top: 30px;
			margin-bottom: 30px;
			display: flex;
			flex-direction: row;
		}

		.reset-button button, .update-button button{
			height: 50px;
			width: 150px;
			font-size: 15px;
			border: 1px transparent;
			align-items: center;
			border-radius: 10px;
			padding: 0px 15px;
			color: white;
			transition-duration: 0.3s;
		}

		.update-button{
			margin-left: auto;
			margin-right: auto;
		}

		.reset-button{
			margin-left: auto;
			margin-right: 100px;
		}

		.reset-button a{
			color: white;
		}

		.update-button a{
			color: white;
			text-decoration: none;
		}

		.reset-button button{
			background-color: #c97a73;
		}

		.update-button button{
			background-color: #73c974;
		}

		.reset-button button:hover, .update-button button:hover{
			opacity: 0.9;
			color: black;
			box-shadow: 0px 0px 5px black;
		}

		.order-history{
			margin: 40px 30px;
			border: 1px solid black;
			border-radius: 20px;
			box-shadow: 0px 0px 20px darkgray;
			width: 600px;
			height: 630px;
			display: flex;
			flex-direction: column;
		}

		.title-order-history{
			padding-bottom: 10px;
			text-align: center;
		}
		
		.table-order-history{
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 30px;
		}

		.total-price{
			margin-left: auto;
			margin-right: auto;
			border: 1px solid black;
			border-radius: 20px;
			box-shadow: 0px 0px 20px darkgray;
			width: 1170px;
			height: 100px;
			display: flex;
			flex-direction: column;
		}

		table, th, td{
			text-align: center;
			border-collapse: collapse;
		}

		tr{
			border: 1px solid black;
		}
		.order-id{
			background-color: #8de391;
		}

		th, td{
			width: 180px;
			height: 40px;
		}

		tr:nth-child(even) {
		    background-color: #dddddd;
		}

		a{
			color: black;
		}

        .message {
            color: red;
            margin-top: 20px;
        }

		.food{ width: 35%; }
        .quantity {width: 4%; }
        .unit {width: 7%; }
		.price{ width: 6%; }
	</style>
</head>
<body>

	<div class="main-box">
		<div class="my-account">
			<div class="my-account-box">
				<div class="title-myaccount"><br><br>
					<h3>Reservation Details</h3>
                </div>
                
                    <?php

                        $query = "SELECT * FROM reservation WHERE reservation_id ='".$reservation_id."';";
                        $res = mysqli_query($conn,$query);

                        while ($record = mysqli_fetch_assoc($res)) {
                            $resID = $record['reservation_id'];
                            $owner_id = $record['owner_id'];
                            $date = $record['reserve_date'];
                            $time = $record['time'];
                            $person = $record['quantity_person'];
                            $total_pay = $record['total_pay'];
                        }

                        $restaurant = "SELECT * FROM restaurant_owner WHERE owner_id =".$owner_id.";";
                        $result_query = mysqli_query($conn,$restaurant);

                        while ($rec = mysqli_fetch_assoc($result_query)) {
                            $res_name = $rec['restaurant_name'];
                            $phone = $rec['phone_no'];
                            $email = $rec['owner_email'];
                        }
                    ?>
					<div class="details">
						<div class="part-detail">
							<div class="label">Reservation ID</div>
							<div class="data-cust">: 
								<?php echo $resID;?>
							</div>
						</div>
						<div class="part-detail">
							<div class="label">Restaurant</div>
							<div class="data-cust">: 
                                <?php echo $res_name;?>
							</div>
						</div>
						<div class="part-detail">
							<div class="label">Date and Time</div>
							<div class="data-cust">: 
                                <?php echo $date;?>&nbsp;<?php echo $time;?>
							</div>
						</div>
						<div class="part-detail">
							<div class="label">Number of People</div>
							<div class="data-cust">: 
                                <?php echo $person;?>
							</div>
						</div>
						<div class="part-detail">
							<div class="label" style="font-weight: bold; font-size: 22px;">TOTAL</div>
							<div class="data-cust" style="font-weight: bold; font-size: 22px;">: 
								RM <?php echo $total_pay;?>
							</div>
						</div>
                    </div>
                    <div class="message">
					    <p style="margin-top: 1rem; text-align:center;"><strong>If you wish to cancel your reservation, kindly contact the restaurant.</strong></p>
                        <p style="text-align: center;"><strong><?php echo $email;?></strong></p>
                        <p style="text-align: center;"><strong><?php echo $phone;?></strong></p>
				    </div>
			</div>
		</div>

		<div class="order-history">
			<div class="title-order-history"><br><br>
				<h3>Food Information</h3>
			</div>
			<div class="table-order-history">
                <?php
                    $food = "SELECT * FROM food_reservation WHERE reservation_id ='".$resID."';";
					$res_food = mysqli_query($conn,$food);
					
                    if($res_food->num_rows > 0) {
                ?>
				<table>
					<tr>
						<th class="food">Food</th>
						<th class="unit">Per Unit</th>
						<th class="quantity">Quantity</th>
						<th class="price">Price</th>
                    </tr>
                    <?php 
                    $food_total = "";
                    while ($rows = mysqli_fetch_assoc($res_food)) {
                        $food_id = $rows['food_id'];
                    ?>
				    <tr>
                        <?php
                            $food_name = "SELECT * FROM food WHERE food_id =".$food_id.";";
                            $result_food = mysqli_query($conn,$food_name);

                            while ($food_record = mysqli_fetch_assoc($result_food)) {
                        ?>
					    <td class="order-id"><?php echo $food_record['food_name'];?></td>
                        <td><?php echo $food_record['food_price'];?></td>
                        <?php
                            }
                        ?>
					    <td><?php echo $rows['qty'];?></td>
					    <td><?php echo $rows['total'];?></td>
                    </tr>
                    
                    <?php 
                        $food_total = (double)$rows['total'] + (double)$food_total;
					}
					
					$total_tax = (double)$food_total * 0.06;
					$total_overall = (double)$food_total + (double)$total_tax;
					?>
					<tr>
						<td colspan="3">Subtotal (RM)</td>
						<td><?php echo number_format($food_total, 2, '.', ''); ?></td>
					</tr>
					<tr>
						<td colspan="3">Service Tax (6%)</td>
						<td>+ <?php echo number_format($total_tax, 2, '.', ''); ?></td>
					</tr>
				    <tr>
					    <td colspan=3 style="font-weight: bold; font-size: 22px;">Total</td>
					    <td style="font-weight: bold; font-size: 22px;">RM&nbsp;<?php echo number_format($total_overall, 2, '.', ''); ?></td>
				    </tr>
                </table>
                
                <div class="message">
                </div>
                <?php
                }
                else {
                    echo "<div class = 'message' style='color:black;'><p>No food order from you. :(</p></div>";
                }
                ?>
			</div>
		</div>
    </div>

	<center>
		<div class="form-button">
			<div class="update-button">
				<button><a href="my-reservation.php">Back</a></button>
			</div>
		</div>
	</center>
</body>
</html>

