<?php
	session_start();
	//include_once 'top-nav.php';
	error_reporting(0); 
	$ownerID=$_SESSION['ownerID'];
    include_once 'dbConn.php';
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

		
.main-box{
	width: 100%;
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	margin-bottom: 50px;
}

.my-account{
	margin: 10px 30px;
	box-shadow: 0px 0px 20px darkgray;
	border-radius: 20px;
	height: 600px;
	width: 500px;
	border: 1px solid black;
}

.my-account-box, .details{
	display: flex;
	flex-direction: column;
	margin: 5px;
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
	margin: 20px;
	display: flex;
	flex-direction: row;
}

.reset-button button, .update-button button{
	height: 40px;
	border: 1px transparent;
	border-radius: 10px;
	margin-left: 30px;
	padding: 0px 15px;
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
	margin: 10px 30px;
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
	margin: 10px;
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

tr:nth-child(even) {
	background-color: #dddddd;
}

a{
	color: black;
}
.all-item{
	margin-top: 0px;
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
}
.item-section{
	border: 1px transparent;
	margin: 15px;
	padding: 10px;
}

.item-section-cat{
	margin-top: 50px;
}
.item-type-name{
	border: 1px transparent;
	box-shadow: 3px 3px 5px lightgray;
	border-radius: 10px;
	text-align: center;
	margin: 10px 0px;
	padding: 10px;
	background-color: darkgreen;
	color: white;
}

.item{
	margin: 10px;
	padding: 10px;
	width: 900px;
	height: 80px;
	border: 1px solid lightgray;
	border-radius: 5px;
	
}

.item:hover{
	box-shadow: 0px 0px 5px gray;
}

.item-img img{
	margin: 5px;
	width: 140px;
	height: 140px;
}

.item-caption{
	margin: 10px 5px;
	
	width:  300px;
	display: inline-block;
}
.item-price{
	height: 25px;
	padding-top: 10px;
	font-size: 15px;
	color: #3fbf48;
	margin: 10px 5px 0px 5px;
	width: 150px;
	display: inline-block;
}

.item-status{
	margin-top: 10px;
	font-family: 'Balsamiq Sans', cursive;
	border-radius: 7px;
	padding-top: 8px;
	border: 1px transparent;
	width: 100px;
	height: 25px;
}

.available{
	font-size: 15px;
	color: white;
	background-color: #65cf6c;
}

.sold-out{
	font-size: 15px;
	color: white;
	background-color: #de4f35;
}

.add-to-cart{
	margin-top: 10px;
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
}

.num-order{
	margin: 0px 5px;
	text-align: center;
	width: 250px;
	height: 30px;
	border: 1px solid lightgray;
	border-radius: 10px;
}

.add-button{
	width: 100px;
	height: 25px;
	margin:  0px 28px 0px 55px;
	border-radius: 10px;
	border: 1px transparent;
	background-color: #65cf6c;
	color: white;
	box-shadow: 0px 0px 10px lightgray;
	display: inline-block;
	text-align: center;
	padding: 5px;

}

.add-button-food{
	width: 170px;
}

.add-button-delete{
	background-color: #de4f35;
}

.add-button:hover{
	background-color: #42cef5;
	box-shadow: 0px 0px 7px black;
}

.item-cart{
	display: flex;
	flex-direction: row;
}

.item-cart img{
	margin: 5px;
	width: 140px;
	height: 140px;
}
.new{
	width: 100%;
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
}
.add-new-product{
	margin-top: 50px;
	width: 800px;
	display: flex;
	flex-wrap: wrap;
	justify-content: flex-end;

}

.add-new-product img{
	margin-top: 5px;
	height: 30px;
	width: 30px;
}

.add-new-product a{
	display: flex;
	flex-direction: row-reverse;
	text-decoration: none;
	color: white;
}
.add-label{
	border-radius: 10px;
	margin-left: -10px;
	text-align: center;
	padding: 10px;
	background-color:  #6abd7a;
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

<div id="main">
<?php
	//include_once 'top-nav.php';
	//$ownerID=3;
    include_once 'dbConn.php';
?>

<span class="navbar-brand-border" style="font-size:30px;cursor:pointer;font-weight: bold" onclick="openNav()">&#9776; </span> <!--3 line-->

<div class="new">
	<div class="add-new-product">
		<div class="add-button-food">
			<a href="admin-menu-add.php">
				<div class="add-label">Add New Food</div>
				<img src="img/add.png">
			</a>
		</div>
	</div>
</div>

<!--Asing ikut kategori-->
<div class="all-item">
<?php
		//$owner_id = 1;

		$food_type = "SELECT * FROM food_type;";
		$foodtype_result = mysqli_query($conn, $food_type);
?>
<div class="item-section">
<?php
	while ($ft_record = mysqli_fetch_assoc($foodtype_result)) {

		$ft = $ft_record['food_type_id'];

		$food_menu = "SELECT * FROM food WHERE owner_id ='".$ownerID."' AND food_type_id = '".$ft."';";
		$food_result = mysqli_query($conn, $food_menu);
		?>
		<div class="item-section-cat">
			<?php	
		if($food_result->num_rows > 0){ ?>
			<div class="item-type-name "><?php echo $ft_record['food_desc']; ?></div>

			<?php	while ($fr_record = mysqli_fetch_assoc($food_result)) {

			?>
				<div class="item">
					<div class="item-caption"><?php echo $fr_record['food_name']; ?></div>
					<div class="item-price">RM <?php echo $fr_record['food_price']; ?></div>
							
					<a href="admin-menu-update.php?food-id=<?php echo $fr_record['food_id']; ?>&owner-id=<?php echo $fr_record['owner_id']; ?>"><div class="add-button">Update</div></a> <!--Akan pass food id dan owner id-->
					<a href="admin-menu.php?action=delete&food-id=<?php echo $fr_record['food_id']; ?>"><div class="add-button" style="background-color: #de4f35;">Delete</div></a>
				</div>
		
		<?php
					}
				}
		?>
			</div>
		<?php
			}
			
		?>
</div>		
</div>		
	


<!--FOODS-->



<!--
  <h2>Sidenav Push Example</h2>
  <p>Click on the element below to open the side navigation menu, and push this content to the right.</p>
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
-->
  
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

<?php
	if(isset($_GET['action'])){
		if($_GET['action'] == "delete"){
			$food_id = $_GET['food-id'];

			$sql = "DELETE FROM food WHERE food_id = '$food_id';";
			$res = mysqli_query($conn,$sql);

			if($res > 0)
			{
				echo "<script>alert('Food successfully deleted');";
				echo "window.location.href = 'admin-menu.php';</script>";
			}
		}
	}
	

	
?>