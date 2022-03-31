<?php 
	//session_start();
	include_once 'dbConn.php';


	if(isset($_GET['action'])){
		if($_GET['action'] == "edit"){
			$food_name = $_POST['foodName'];
			$food_type_id = $_POST['foodType'];
            $food_price = $_POST['foodPrice'];
            $food_id = $_POST['foodID'];
            $owner_id = $_POST['ownerID'];
            
			

			$sql = "UPDATE food SET food_name = '$food_name', food_type_id = '$food_type_id', food_price = '$food_price' WHERE owner_id ='$owner_id' AND food_id = '$food_id';";
			$res = mysqli_query($conn,$sql);

			if($res > 0){
				echo "<script>alert('Food has successfully updated !');";
        		echo "window.location.href = 'admin-menu.php';</script>";
			}
		}
	}

?>