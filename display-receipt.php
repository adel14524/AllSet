<?php
  session_start();
  include_once 'top-nav.php';
  include_once 'dbConn.php';

  $custID=$_SESSION['custID'];
  $ownerID=$_SESSION['restaurant'];

  $date_time = $_POST['date-time'];
  $qty_person = $_POST['qty-person'];
  $total = $_POST['total-pay'];
  $status = 'Active';

  $total_pay = number_format($total, 2, '.', '');

  $myvalue = $date_time;

  $datetime = new DateTime($myvalue);

  $date = $datetime->format('Y-m-d');
  $time = $datetime->format('H:i:s');

  $reservation_id = 'RES-'.time();

  $insert_res = "INSERT INTO `reservation` (`reservation_id`, `user_id`, `owner_id`, `reserve_date`, `time`, `quantity_person`, `total_pay`, `status`) VALUES ('$reservation_id','$custID','$ownerID','$date','$time','$qty_person',' $total_pay','$status');";
  $result_insert = mysqli_query($conn,$insert_res);

  foreach($_SESSION['cart_food'] as $key => $value){

    $food_id = $value['food_id'];
    $qty = $value['quantity'];
    $total_fp = $value['quantity'] * $value['food_price'];

    $insert_food = "INSERT INTO `food_reservation` (`reservation_id`, `food_id`, `qty`, `total`) VALUES ('$reservation_id','$food_id','$qty','$total_fp');";
    $query_result = mysqli_query($conn,$insert_food);
  }

  $sql = "SELECT * FROM reservation WHERE reservation_id = '".$reservation_id."';";
  $res = mysqli_query($conn,$sql);

  while ($row = mysqli_fetch_assoc($res)) {
    $resID = $row['reservation_id'];
    $owner_id = $row['owner_id'];
    $date = $row['reserve_date'];
    $time = $row['time'];
    $no_person = $row['quantity_person'];
  }

  $query = "SELECT * FROM restaurant_owner WHERE owner_id = ".$owner_id.";";
  $result = mysqli_query($conn,$query);

  while ($record = mysqli_fetch_array($result)) {
    $res_name = $record['restaurant_name'];
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Receipt</title>
  <style type="text/css">
    body{
      font-family: sans-serif;
      margin: 0px;
      padding: 0px;
    }

    a{
      padding-top: 10px;
      text-decoration: none;
    }

    .receipt{
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .display-receipt{
      width: 450px;
      height: 790px;
      display: flex;
      border: 1px solid black;
      border-radius: 20px;
      padding: 10px;
      margin-top: 50px;
    }

    .all, .display-receipt{
      display: flex;
      flex-direction: column;
    }

    .float-right{
      float: right;
    }

    .detail-receipt{
      margin-top: 20px;
    }
    .detail-gap{
      height: 60px;
    }

    .label{
      font-weight: bold;
      width: 40%;
      text-align: right;
    }

    .label, .detail{
      padding-top: 20px;
    }

    .detail{
      margin-left: 20px; 
      font-weight: bold;
    }

    .paid img{
      margin-top: 10px;
      width: 40px;
      height: 40px;
      margin-left: 30px;
    }
    
    .paid, .order-id, .order-date, .total-payment, .parcel-num{
      display: flex;
      flex-direction: row;
    }
    
    .company-logo{
      margin: 20px;
    }
    .company-logo img{
      width: 40%;
    }

    .button-back-print{
      margin-top: 20px;
      width: 420px;
      margin-bottom: 20px;
      margin-left: 10px;
    }

    .button-back-print button{
      height: 50px;
      padding: 10px 15px;
      opacity: 0.6;
      transition-duration: 0.3s;
    }

    .button-back-print button:hover{
      opacity: 1.0;

    }

    .print{
      align-items: center;
    }
    .print p{
      margin-top: 4px;
    }

    .print button{
      width: 200px;
      background-color:#44c767;
      border-radius:28px;
      border:1px solid #18ab29;
      display:inline-block;
      cursor:pointer;
      color:#ffffff;
      font-family:Arial;
      font-size:17px;
      padding:10px 21px;
      text-decoration:none;
      text-shadow:0px 1px 0px #2f6627;
      float: left;
    }

    .print img{
      display: block;
      width: 30px;
      height: 30px;
      float: left;
    }

    .return button{
      background-color:#44c767;
      border-radius:28px;
      border:1px solid #18ab29;
      display:inline-block;
      cursor:pointer;
      color:#ffffff;
      font-family:Arial;
      font-size:17px;
      padding:10px 21px;
      text-decoration:none;
      text-shadow:0px 1px 0px #2f6627;
      float: right;
    }

  </style>
</head>
<body>

  <div class="receipt">
    <div class="all">
      <div class="display-receipt">
        <div class="thankyou-label">
          <div class="company-logo">
            <center><img src="img/set.png"></center>
          </div>
          <h2 style="text-align: center;"><strong>Reservation Complete !</strong></h2>
          <p style="text-align: center; font-size: 15px;"><i><br>Thank you for your reservation.<br>You can view or cancel your reservation in the "My Reservation" page.<p style="text-align: center; font-size: 15px;"><strong>Please print this receipt for future reference.</strong></p></i></p>
          <p class="float-right"><strong>~~ From All Set Sdn Bhd</strong></p>
        </div>


        <div class="detail-receipt">
          <div class="order-id detail-gap">
             <div class="label">Reservation ID : </div>
             <div class="detail"><?php echo $resID; ?></div>
          </div>
          <div class="order-date detail-gap">
             <div class="label">Restaurant : </div>
             <div class="detail"><?php echo $res_name; ?></div>
          </div>
          <div class="total-payment detail-gap">
             <div class="label">Reservation Date : </div>
             <div class="detail"><?php echo $date ; ?></div>
          </div>
          <div class="total-payment detail-gap">
             <div class="label">Reservation Time : </div>
             <div class="detail"><?php echo $time ; ?></div>
          </div>
          <div class="parcel-num detail-gap">
             <div class="label">No of person : </div>
             <div class="detail"><?php echo $no_person ; ?></div>
          </div>

        </div>
      </div>

      <div class="button-back-print">
        <div class="print">
          <button onclick="window.print() ">
            <p>Print receipt</p>
            </button>
        </div>
      <?php unset($_SESSION["cart_food"]);  ?>
        <div class="return">
          <button onclick="window.location.href='list-restaurant.php';">Done Reservation</button>
        </div>
      </div>
    </div>
  </div>
  



</body>
</html>