<?php 
    include_once 'dbConn.php';
    session_start();
	  error_reporting(0); 
	  $ownerID=$_SESSION[ownerID];
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Reservation</title>
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

table{
  box-shadow: 1px 1px 20px darkgray;
  margin: 10px 10px;
  width: 90%;
}

table tr:hover{
  background-color: lightgray;
}

th{
  background-color: #393939;
  color: white;
  padding: 8px 10px;
}

table, th, td{
	text-align: center;
	border-collapse: collapse;
  border: 1px solid lightgray;
}

tr{
	border: 1px solid black;
  background-color: whitesmoke;
}

th, td{
	width: 180px;
	height: 40px;
}

.reset-button button, .update-button button{
	height: 40px;
  width: 65px;
  font-size: 14px;
	border: 1px transparent;
	border-radius: 10px;
	padding: 0px 15px;
	margin-left: 30px;
  margin-right: 30px;
  margin-bottom: 10px;
  margin-top: 10px;
	color: white;
	transition-duration: 0.3s;
}

.update-button button{
	background-color: #4f58d1;
}

.reset-button button{
			background-color: #c97a73;
		}

.reset-button button:hover, .update-button button:hover{
	opacity: 0.9;
	color: black;
	box-shadow: 0px 0px 5px black;
}

.container{
  margin: 40px 30px;
	display: flex;
	flex-direction: column;
}

@media screen and (max-width:450px) {
    .container{
      overflow-x: auto;
    }
}

.column {
  float: left;
  width: 50.00%;
  padding: 15px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

@media screen and (max-width:600px) {
  .column {
    width: 100%;
  }
}

.select-status{
  width: auto;
  margin: 20px;
  margin-right: 10px;
  margin-top: 10px;
  float: left;
}

select{
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
  padding: 10px;
  font-size: 15px;
}

select:focus {
  border: 3px solid #555;
}

.button{
  width: auto;
}

.date-time{width: 20%;}
.status {width: 23%;}
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
    <div class="container">
        <div class="title-order-history">
            <h1 style="font-size: 55px;">List of Reservation</h1>
        </div>
        <div class="table-order-history">
            <table>
                <?php
                    $sql = "SELECT * FROM reservation WHERE owner_id = '".$ownerID."';";
                    $result = mysqli_query($conn,$sql);

                    if ($result->num_rows > 0) {

                ?>
                <tr>
                    <th>Reservation ID</th>
                    <th>Customer Name</th>
                    <th>Phone No</th>
                    <th class="date-time">Date and Time</th>
                    <th>Total Payment (RM)</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['reservation_id'];?></td>
                    <?php
                        $query = "SELECT * FROM user WHERE user_id =".$row['user_id'].";";
                        $res = mysqli_query($conn,$query);

                        while ($record = mysqli_fetch_assoc($res)) {
                    ?>

                    <td><?php echo $record['name'];?></td>
                    <td><?php echo $record['phone_num'];?></td>
                    <td><?php echo $row['reserve_date'];?>&nbsp;<?php echo $row['time'];?></td>
                    <td><?php echo $row['total_pay'];?></td>
                    <td class="status">
                      <form method="POST" action="view-reservation.php?action=update">
                        <div class="select-status">
                          <select name="status" style="height: 40px; border-radius: 10px; width: 130px;" placeholder="<?php echo $row['status'];?>">
                            <option disabled selected value><?php echo $row['status'];?></option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                          </select>
                        </div>
                        <input type="hidden" name="res-id" value="<?php echo $row['reservation_id'];?>">  
                        <div class="button">
                          <div class="form-button">
                            <div class="reset-button">
                              <button type="submit" style="margin-left: 0px; margin-right:5px; padding: 10px;">Update</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </td>
                    <td style="text-align: center;"><div class="update-button"><a href="view-detail.php?resID=<?php echo $row['reservation_id'];?>&userID=<?php echo $record['user_id'];?>" style="text-decoration: none;"><button type="button">View</button></a></div></td>
                    <?php
                        }
                    ?>
                </tr>
                <?php
                        }
                ?>
            </table>
            <?php
                    }
            ?>
        </div>
    </div>
    <?php

      if (isset($_GET['action'])) {
        if ($_GET['action'] == 'update') {
          $reservation_id = $_POST['res-id'];
          $status = $_POST['status'];

          $query = "UPDATE `reservation` SET `status` = '".$status."' WHERE `reservation_id` = '".$reservation_id."';";
          $result = mysqli_query($conn,$query);

          if ($result) {
            echo '<script>alert("Current Status has been UPDATED!")</script>';
        echo '<script>window.location="view-reservation.php"</script>';
          }
          else {
              
          }
        }
      }
    ?>
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

