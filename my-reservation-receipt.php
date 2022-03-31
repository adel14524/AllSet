<?php 
    session_start();
    include_once 'top-nav.php';
    include_once 'dbConn.php';

    $reservation_id = $_GET['resID'];

    $sql = "SELECT * FROM reservation WHERE reservation_id ='".$reservation_id."';";
    $res = mysqli_query($conn,$sql);

    while ($row = mysqli_fetch_assoc($res)) {
        $resID = $row['reservation_id'];
        $owner_id = $row['owner_id'];
        $date = $row['reserve_date'];
        $time = $row['time'];
        $no_person = $row['quantity_person'];
    }

    $query = "SELECT restaurant_name FROM restaurant_owner WHERE owner_id = ".$owner_id.";";
    $result = mysqli_query($conn,$query);

    while ($record = mysqli_fetch_assoc($result)) {
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
      width: 180px;
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
      width: 43%;
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
             <div class="detail"><?php echo $res_name ; ?></div>
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

        <div class="return">
          <button onclick="window.location.href='my-reservation.php';">Back</button>
        </div>
      </div>
    </div>
  </div>
  



</body>
</html>