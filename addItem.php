<?php
		include 'dbConn.php';
		
		$food_name = $_POST['foodName'];
		$food_type_id = $_POST['foodType'];
		$food_price = $_POST['foodPrice'];
		$food_id = $_POST['foodID'];
		$owner_id = $_POST['ownerID'];
		
		
		$sql= "INSERT INTO food (owner_id,food_name,food_type_id, food_price) VALUES ('$owner_id','$food_name','$food_type_id','$food_price')";
		$res = mysqli_query($conn,$sql);

		header('Location:admin-menu.php');
	?>