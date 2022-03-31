<?php
	session_start();
    include_once 'top-nav.php';
	include_once 'dbConn.php';
	
	$user_id = $_SESSION['custID']; 

	$get_email = "SELECT * FROM `user` WHERE `user_id` = ".$user_id.";";
	$result_email = mysqli_query($conn,$get_email);

	while ($rec = mysqli_fetch_assoc($result_email)) {
		$email = $rec['email'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Reservation</title>
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
			height: 600px;
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
			margin-top: 70px;
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
		.data-cust{width: 300px;}

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
			margin: 50px;
			display: flex;
			flex-direction: row;
		}

		.reset-button button, .update-button button{
			height: 40px;
			border: 1px transparent;
			border-radius: 10px;
			padding: 0px 15px;
			margin-left: 30px;
			color: white;
			transition-duration: 0.3s;
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
			height: 600px;
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
			margin-top: 30px;
			margin-left: 20px;
			margin-right: 20px;
			overflow-y:auto;
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
			width: 200px;
			height: 40px;
		}

		th {
			text-align: center;
		}

		td {
			height: 60px;
		}

		tr:nth-child(even) {
		    background-color: #dddddd;
		}

		a{
			color: black;
		}

	</style>
</head>
<body>

	
	<div class="main-box">
		<div class="my-account">
			<div class="my-account-box">
				<div class="title-myaccount"><br><br>
					<h3>My Account</h3>
				</div>
				<form method="POST" action="my-reservation.php?action=edit">

					<?php
						$sql = "SELECT * FROM user WHERE email = '".$email."';";
						$result = mysqli_query($conn,$sql);

						$user_id = $name = $password = $email = $phone_num = "";

						while ($record = mysqli_fetch_assoc($result)) {
							$user_id = $record['user_id'];
							$name = $record['name'];
							$email = $record['email'];
							$phone_num = $record['phone_num'];
						}
					?>
					<div class="details">
						<div class="part-detail">
							<div class="label">Your Email</div>
							<div class="data-cust">: 
								<?php echo $email; ?>
							</div>
						</div>
						<div class="part-detail">
							<div class="label">Your Name</div>
							<div class="data-cust">: 
								<input type="text" name="name" value="<?php echo $name; ?>" required>
							</div>
						</div>
						<div class="part-detail">
							<div class="label">Phone Number </div>
							<div class="data-cust">: 
								<input type="text" name="phone-num" value="<?php echo $phone_num; ?>" required>
							</div>
						</div>
					</div>

					<input type="hidden" name="user-id" value="<?php echo $user_id; ?>">

					<div class="form-button">
						<div class="reset-button">
							<button type="reset" value="Reset">Reset</button>
						</div>
						<div class="update-button">
							<button type="submit" value="edit">Update My Account</button>
						</div>
					</div>

				</form>
			</div>
		</div>


		<div class="order-history">
			<div class="title-order-history"><br><br>
				<h3>Order History</h3>
			</div>
			<div class="table-order-history">

				<?php
					$query = "SELECT * FROM reservation WHERE user_id =".$user_id.";";
					$res = mysqli_query($conn,$query);

					if ($res->num_rows > 0) {
				?>

				<table>
					<tr>
						<th>Reservation ID</th>
						<th>Date and Time</th>
						<th>Action</th>
					</tr>

				<?php 
					while ($row = mysqli_fetch_assoc($res)) {
				?>
					
					<tr>
						<td class="order-id"><a href="my-reservation-receipt.php?resID=<?php echo $row['reservation_id'];?>" style="text-decoration: none; color:black;"><?php echo $row['reservation_id'];?></a></td>
						<td><?php echo $row['reserve_date'];?>&nbsp;<?php echo $row['time'];?></td>
						<td><div class="update-button"><button style="background-color: #4f58d1;"><a href="reservation-detail.php?resID=<?php echo $row['reservation_id'];?>" style="text-decoration: none; color:black">Details</a></button></div></td>
					</tr>
				<?php
					}
				?>

				</table>

				<div class="message">
					<p style="margin-top: 1rem;">You may click any Reservation ID number to check the receipt.</p>
					<p style="text-align: center;">You may click 'Details' button to check your reservation details</p>
				</div>
				
                <?php }
				else 
					echo "<div class = 'message' style='color:black;'><p>No reservation from you yet. :(</p></div>";
				?>
			</div>
		</div>
	</div>

</body>
</html>

<?php
	if (isset($_GET['action'])) {
		if ($_GET['action'] == "edit") {
			$user = $_POST['user-id'];
			$new_name = $_POST['name'];
			$new_phone = $_POST['phone-num'];

			$query = "UPDATE user SET `name` = '$new_name' , phone_num = '$new_phone' WHERE user_id = $user;";
			$result = mysqli_query($conn,$query);

			if ($result) {
				echo '<script>alert("Your Profile has been UPDATED!")</script>';
				echo '<script>window.location="my-reservation.php"</script>';
			}
		}
	}

?>