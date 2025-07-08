<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>BPMS || Customer List</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		 <?php include_once('includes/sidebar.php');?>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		 <?php include_once('includes/header.php');?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h3 class="title1">Search Payments by Email</h3>
					
					
				
					<div class="table-responsive bs-example widget-shadow">
						<h4>Search Customer Payments:</h4>
						<div class="form-body">
							<form method="post" name="search" action="">
								<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>

  
							 <div class="form-group"> <label for="exampleInputEmail1">Enter Customer Email Address</label> <input id="searchdata" type="email" name="searchdata" required="true" class="form-control" placeholder="example@email.com">
						
							<br>
							  <button type="submit" name="search" class="btn btn-primary btn-sm">Search Payments</button> </form> 
						</div>
						<?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
  <h4 align="center">Payment Records for Email: "<?php echo $sdata;?>" </h4> 
						<table class="table table-bordered"> 
							<thead> <tr> 
								<th>#</th> 
								<th>Customer Name</th> 
								<th>Email</th>
								<th>Service</th>
								<th>Amount</th>
								<th>Card Number</th>
								<th>Payment Date</th>
								<th>Action</th>
							</tr> 
							</thead> <tbody>
<?php
$ret=mysqli_query($con,"SELECT * FROM tblpayment WHERE CustomerEmail = '$sdata' ORDER BY PaymentDate DESC");
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
// Mask card number for security
$maskedCard = 'xxxx-xxxx-xxxx-' . substr($row['CardNumber'], -4);
?>

						 <tr> 
						 	<th scope="row"><?php echo $cnt;?></th> 
						 	<td><?php  echo htmlentities($row['CustomerName']);?></td>
						 	<td><?php  echo htmlentities($row['CustomerEmail']);?></td>
						 	<td><?php  echo htmlentities($row['ServiceName']);?></td>
						 	<td><b>₹<?php  echo number_format($row['PaymentAmount'], 2);?></b></td>
						 	<td><?php  echo $maskedCard; ?></td>
						 	<td><?php 
						 		echo date('d-m-Y H:i', strtotime($row['PaymentDate'])); 
						 	?></td>
						 	<td>
						 		<a href="view-payment.php?id=<?php echo $row['ID'];?>" class="btn btn-primary">View</a>
						 		<a href="all-payments.php?delid=<?php echo $row['ID'];?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this payment record?');">Delete</a>
						 	</td>
						 </tr>   <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> No payment records found for this email address</td>

  </tr>
   
<?php } }?></tbody> </table> 
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
		 <?php include_once('includes/footer.php');?>
        <!--//footer-->
	</div>
	<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js"> </script>
</body>
</html>
<?php }  ?>