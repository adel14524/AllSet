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

		


.label{width: 150px; padding: 10px; }
.data-cust{width: 300px;}


.reset-button button:hover, .update-button button:hover{
	opacity: 0.9;
	color: black;
	box-shadow: 0px 0px 5px black;
}


.all-item{
	
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	width: 600px;
    background-color: #2a9d8f;
    border: 1px solid gray;
    border-radius: 10px;
    margin: 70px auto;
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
.addForm{
    width: 1000px;
}
.leftcol,.rightcol{
    width: 45%;
    
    padding: 20px;
    height: 100%;
    margin: 0 auto;
}



button{
    width: 300px;
    height: 50px;
    background-color: #d90429;
    color: #e6e6ea;
    font-family: 'Poppins', sans-serif;
    font-size: inherit;
    font-weight: 600;
    margin-bottom: 1rem;
    outline: none;
    border-radius: 10px;
    
}

.addorderBTN{
    
    margin:10px ;
    
}


/* Clear floats after the columns 
.addForm:after {
content: "";
display: table;
clear: both;
}*/

input[type=text], select {
width: 100%;
padding: 12px 20px;
margin: 8px 0;
display: block;
border: 1px solid #ccc;
border-radius: 4px;
box-sizing: border-box;
}
input[type="file"] {
height: 0;
overflow: hidden;
width: auto;
}

input[type="file"] + label {
background: #d90429;
border: none;
border-radius: 5px;
color: #fff;
cursor: pointer;
display: inline-block;
font-family: 'Poppins', sans-serif;
font-size: inherit;
font-weight: 600;
margin-bottom: 1rem;
outline: none;
padding: 1rem 50px;
position: relative;
transition: all 0.3s;
vertical-align: middle;
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

<!--Start  here ##############################-->
<div id="main">
    <!--this is main body-->
    <span class="navbar-brand-border" style="font-size:30px;cursor:pointer;font-weight: bold" onclick="openNav()">&#9776; </span> <!--3 line-->
    
    <div class="all-item">
		
		<div class="tajuk">
			<h1>Add new Food</h1>
		</div>

		<form action="addItem.php" method="POST" enctype="multipart/form-data " onsubmit=" return success()">
		<div class="addForm">

				<div class="leftcol " >
					<div class=input-col1>
						<label for="prodId">Food name</label>
						<input type="text" id="prodID" name="foodName" required><br>
					</div>
					<div class=input-col1>
						<label for="prodId">Food Category</label>
						<select id="prodId" name="foodType" required>
							<option value="" >Select Category</option>
							<option value="LC">Local Cuisines</option>
							<option value="WS">Western</option>
							<option value="PZ">Pizza</option>
							<option value="DR">Drinks</option>
						</select>
					</div>
					
					<div class="col1">
						<label for="prodId">Food Price</label>
						<input type="text" name="foodPrice" placeholder="RM" required><br>
					</div>
				</div>

				<input  type="hidden" name="ownerID" value="<?php echo $ownerID;?>" required><br>

		</div>
			
		<div class="addorderBTN">
			<center><button type="submit" value="Add product" name="submit">ADD FOOD</button></center>
		</div>
	</form>
			  
	</div>
    
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