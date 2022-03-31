<?php
	include_once 'dbConn.php';
	session_start();
	error_reporting(0); 
	$ownerID=$_SESSION['ownerID'];
	$reservation_id = $_GET['resID'];
	$user_id = $_GET['userID'];
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

.navbar-brand-border{
	border: 1px solid black;
	padding: 5px;
	border-radius: 7px;
	box-shadow: 0px 0px 20px darkgray;
}

.navbar-brand-border:hover{
	box-shadow: 0px 0px 7px black;
	
}

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
	height: 800px;
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
	height: 800px;
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

    <?php
                
	$sql = "SELECT * FROM restaurant_owner WHERE owner_id = '$ownerID';";
	$result = mysqli_query($conn, $sql);

	$resName = $ownName = $phone = $email = $image = "";

	while ($record = mysqli_fetch_assoc($result)) {
		$resName = $record['restaurant_name'];
		$ownName = $record['owner_name'];
		$phone = $record['phone_no'];
		$email = $record['owner_email'];
		$image = $record['restaurant_img'];

		
	}
	
	?>
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="#">Welcome <?php echo $ownName ;?></a>
		<a href="admin-homepage.php">Home</a>
		<a href="view-reservation.php">Reservation</a>
		<a href="admin-menu.php">Menu</a>
		<a href="logOut.php">Log Out</a>
		<!--<a href="#">Contact</a> -->
	</div>

<!--Start  here ##############################-->
<div id="main">
    <!--this is main body-->
    <span class="navbar-brand-border" style="font-size:30px;cursor:pointer;font-weight: bold" onclick="openNav()">&#9776; </span> <!--3 line-->
    <div class="main-box">
            <div class="my-account">
                <div class="my-account-box">
					<div class="title-myaccount"><br><br>
                        <h3>Customer Details</h3>
					</div>

					<?php
						$cust_detail = "SELECT * FROM user WHERE user_id =".$user_id.";";
						$result_cust = mysqli_query($conn,$cust_detail);

						while ($cust_record = mysqli_fetch_assoc($result_cust)) {
					?>
					
					<div class="details">
						<div class="part-detail">
                            <div class="label">Email</div>
                            <div class="data-cust">: 
                                <?php echo $cust_record['email'];?>
                            </div>
						</div>
						<div class="part-detail">
                            <div class="label">Name</div>
                            <div class="data-cust">: 
							<?php echo $cust_record['name'];?>
                            </div>
						</div>
						<div class="part-detail">
                            <div class="label">Phone No</div>
                            <div class="data-cust">: 
							<?php echo $cust_record['phone_num'];?>
                            </div>
                        </div>
					</div>

					<?php
						}
					?>

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
                    <a href="view-reservation.php"><button>Back</button></a>
                </div>
            </div>
    </center>
</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
   
</body>
</html> 