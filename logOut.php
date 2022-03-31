<?php
session_start();
include_once('dbConn.php');

?>
<!DOCTYPE html>
<html>
<body>

<?php
error_reporting(0);
    if($_SESSION['cust_Email']=='gc@admin.com'){
            // remove all session variables
    session_unset();

    //clear table temp
    //$clear="DELETE FROM temp";
    //$db=mysqli_query($conn, $clear);
    // destroy the session
    session_destroy();
    header("Location:index.php");
    } 
    else{
        // remove all session variables
    session_unset();

    //clear table temp
    //$clear="DELETE FROM temp";
    //$db=mysqli_query($conn, $clear);
    // destroy the session
    session_destroy();
    echo'<script> alert("Log out successfully !");';
    echo'window.location="index.php";';
    echo'</script>';
    
    
    }

    
?>

</body>
</html>