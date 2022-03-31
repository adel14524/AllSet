<?php
    include 'dbConn.php';
    $FN=$_POST['FN'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $pw=$_POST['pw'];
    $type=$_POST['type'];
    
    

    $sql= "INSERT INTO user (name,password,email,phone_num,user_type_id) VALUES ('$FN','$pw','$email','$phone','$type')";
    $result=mysqli_query($conn,$sql);

    $query = "SELECT * FROM `membership` WHERE cust_Email='$FN' and cust_Password='$PW'";
	if($query)
    if($result)
    header('Location:index.php');
?>