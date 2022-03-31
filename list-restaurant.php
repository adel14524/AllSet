<?php
	session_start();

	include_once 'dbConn.php';
	include_once 'top-nav.php';
	include_once 'img-slide-index.php';

	if(isset($_SESSION["cart_food"])){
	 	echo '<script>alert("YOUR CART IS NOT EMPTY")</script>';
	 	unset($_SESSION["cart_food"]);
	 	//
	}else{
		//echo '<script>window.history.back();</script>';
	}
?>

<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">

<style type="text/css">
	.list-restautants{
		margin: 30 20 100 20;
	}

	.view-button{
		width: 100%; 
		box-shadow: 0px 0px 5px black;
		border-radius: 20px;
		padding: 20px 50px 20px 20px;
		background-color: #f2f2f0;
		margin-bottom: 25px;
	}

	.view-button:hover{
		box-shadow: 0px 0px 10px black;
		background-color: white;
	}

	.rest-detail img{
		border-radius: 20px;
		max-width: 200px;
		max-height: 200px;
	}

	.rest-info{
		margin-left: 40px;
	}

	label{
		font-family: 'Noto Sans TC', sans-serif;
	}

	.empty-gap{
		margin: 15px;
	}

</style>

<div class="d-flex justify-content-center list-restautants">
	<div class="d-flex flex-column">
		<center><h2><span><i class="fas fa-utensils" style="color: #a3b500; margin-bottom: 20px;"></i>&nbsp; Choose Your Restaurant</span></h2></center>

		<?php
			$restaurant_detail = "SELECT * FROM restaurant_owner;";
			$result = mysqli_query($conn, $restaurant_detail);

			while ($record = mysqli_fetch_assoc($result)) {

		?>

		
		<div class="view-button" ?>
			<div class="row rest-detail" >
				<div class="col-md-12">
					<div class="d-flex flex-row">
						<img src="<?php echo $record['restaurant_img']; ?>">
						<div class="d-flex flex-column rest-info">
							<div class="row">
								<h4><span><i class="fas fa-store-alt"></i>&nbsp; <?php echo $record['restaurant_name']; ?></span></h4>
							</div>
							<div class="empty-gap"></div>
							<div class="d-flex flex-column owner-detail">
								<div class="row">
									<i class="fas fa-street-view">&nbsp; 
									<label>Owner : <?php echo $record['owner_name']; ?></label></i>
								</div>
								<div class="row">
									<i class="fas fa-phone">&nbsp; 
									<label>Contact : <?php echo $record['phone_no']; ?></label></i>
								</div>
								<div class="row">
									<i class="fas fa-book">&nbsp; 
									<label>Availibility : <?php echo $record['available']; ?></label></i>
								</div>
							</div>
						</div>
					</div>
					<div class="button-view-rest" style="margin-top:10px;">
						<a href="food_menu_customer.php?action=shop&id=<?php echo $record['owner_id']; ?>" type="button" class="btn btn-primary btn-md btn-block">Make Reservation</a>
					</div>
					
				</div>
			</div>
		</div>

		<?php
			}
		?>
		
	</div>
	
</div>

<script type="text/javascript">
	
	$(document).ready(function () {
		$('body').on('click','.view2-button',function () {

            var id = "" ;
            if($(this).attr('data-key'))
                id = $(this).data('key');
            window.location = "/" + id;     
        });
	})


</script>

