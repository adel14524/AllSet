<?php
    session_start();
    include_once 'dbConn.php';
    $FNcheck="";
    $PWcheck="";
    
    $_SESSION["cust_Email"] = $_POST['email'];
    $email=$_POST['email'];
          
    

    if (isset($_POST['email']) and isset($_POST['password'])){
    
        // Assigning POST values to variables.
        $FN=$_POST['email'];
        $PW=$_POST['password'];

        $query = "SELECT user_type_id FROM `user` WHERE email='$FN' and password='$PW'";
        $res = mysqli_query($conn, $query);
        
        while($row = mysqli_fetch_assoc($res)){
            $userType = $row['user_type_id'];
        }
        //$count = mysqli_num_rows($result);
        //$row = mysqli_fetch_assoc($res);
        //$row = mysql_fetch_array($res);
        //$userType=$res;

        if($userType=="O"){
            $query = "SELECT user_id FROM `user` WHERE email='$FN' AND password='$PW'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            
            while($row=mysqli_fetch_assoc($result)){
                $_SESSION['ownerID']=$row['user_id'];
            }
            
            $count = mysqli_num_rows($result);
            
            if ($result){
            
            //echo "Login Credentials verified";
            
            echo '<script type="text/javascript">'; 
            echo 'alert("Owner Login Credentials verified");';  
            echo 'window.location= "admin-homepage.php";';
            echo '</script>'; 
            //header('Location:product.php');
            }else{
            echo '<script type="text/javascript">'; 
            echo 'alert("salah");'; 
            echo 'window.location= "index.php";';
            echo '</script>'; 
            }
        }else {
                // CHECK FOR THE RECORD FROM TABLE
            $query = "SELECT user_id FROM `user` WHERE email='$FN' AND password='$PW'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            
            while($row=mysqli_fetch_assoc($result)){
                $custID=$row['user_id'];
            }

            $_SESSION['custID'] = $custID;
            
            $query = "SELECT * FROM `user` WHERE email='$FN' and password='$PW'";
            
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            $count = mysqli_num_rows($result);
            
            if ($count == 1){
            
            //echo "Login Credentials verified";
            
            echo '<script type="text/javascript">'; 
            echo 'alert("Welcome to AllSet");'; 
            echo 'window.location= "list-restaurant.php";';
            echo '</script>'; 
            //header('Location:product.php');
            }else{
            echo '<script type="text/javascript">'; 
            echo 'alert("Invalid Login Credentials");'; 
            echo 'window.location= "index.php";';
            echo '</script>'; 
            }
        }
              


    }

    
?>
