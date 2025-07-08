<?php
session_start();
error_reporting(E_ALL); // Enable error reporting temporarily
ini_set('display_errors', 1);

include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_GET['delid'])) {
    $pid = mysqli_real_escape_string($con, $_GET['delid']);
    $delete_query = "DELETE FROM tblpayment WHERE ID = '$pid'";
    if(mysqli_query($con, $delete_query)) {
        echo "<script>alert('Payment Record Deleted Successfully');</script>";
        echo "<script>window.location.href='all-payments.php'</script>";
    } else {
        echo "<script>alert('Failed to delete record. Please try again.');</script>";
    }
}

// First, let's check if the table exists and create it if it doesn't
$check_table = mysqli_query($con, "SHOW TABLES LIKE 'tblpayment'");
if(mysqli_num_rows($check_table) == 0) {
    // Table doesn't exist, create it with all necessary columns
    $createTable = "CREATE TABLE IF NOT EXISTS tblpayment (
		ID int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		CustomerName varchar(120) DEFAULT NULL,
		CustomerEmail varchar(120) DEFAULT NULL,
		ServiceName varchar(120) DEFAULT NULL,
		PaymentAmount decimal(10,2) DEFAULT NULL,
		CardNumber varchar(20) DEFAULT NULL,
		ExpiryDate date DEFAULT NULL,
		CVV varchar(4) DEFAULT NULL,
		PaymentDate timestamp NULL DEFAULT current_timestamp()
	)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    if(mysqli_query($con, $create_table)) {
        echo "<script>alert('Payment table created successfully');</script>";
    } else {
        echo "<script>alert('Error creating table: " . mysqli_error($con) . "');</script>";
    }
}

// Check if ServiceName column exists
$check_service_column = mysqli_query($con, "SHOW COLUMNS FROM tblpayment LIKE 'ServiceName'");
if(mysqli_num_rows($check_service_column) == 0) {
    // Add ServiceName column if it doesn't exist
    $add_service_column = "ALTER TABLE tblpayment ADD COLUMN ServiceName varchar(255) DEFAULT NULL";
    mysqli_query($con, $add_service_column);
}

// Now let's fetch data from the payment form table and insert into tblpayment
$check_data = mysqli_query($con, "SELECT COUNT(*) as count FROM tblpayment");
$row = mysqli_fetch_assoc($check_data);
}

  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>BPMS || All Payments</title>

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
					<h3 class="title1">All Payments</h3>
					
					<div class="table-responsive bs-example widget-shadow">
						<div class="col-6">
							<h4>Payment Records:</h4>
						</div>
						<div class="col-6 text-right">
							<form method="POST" id="payment_filter">
								<input type="date" name="dateFrom" value="<?php echo isset($_POST['dateFrom']) ? $_POST['dateFrom'] : ''; ?>" style="border: 1px solid #ccc; margin-bottom:10px">
								<button type="submit" class="btn btn-sm btn-primary">Apply</button>
								<a href="all-payments.php" class="btn btn-sm btn-danger">Reset</a>
							</form>
						</div>

						<table class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>Customer Name</th>
									<th>Email</th>
									<th>Service</th>
									<th>Amount</th>
									<th>Card Number</th>
									<th>CVV</th>
									<th>Payment Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$new_date = isset($_POST['dateFrom']) ? $_POST['dateFrom'] : '';

								// Modified query to use correct column names
								$query = "SELECT * FROM tblpayment";
								if(!empty($new_date)) {
									$query .= " WHERE DATE(PaymentDate) = '$new_date'";
								}
								$query .= " ORDER BY ID DESC";

								$result = mysqli_query($con, $query);
								
								if($result && mysqli_num_rows($result) > 0) {
									$cnt = 1;
									while($row = mysqli_fetch_assoc($result)) {
										// Mask card number for security
										$maskedCard = 'xxxx-xxxx-xxxx-' . substr($row['CardNumber'], -4);
										?>
										<tr>
											<td><?php echo $cnt; ?></td>
											<td><?php echo htmlentities($row['CustomerName']); ?></td>
											<td><?php echo htmlentities($row['CustomerEmail']); ?></td>
											<td><?php echo htmlentities($row['ServiceName']); ?></td>
											<td><b>₹<?php echo number_format($row['PaymentAmount'], 2); ?></b></td>
											<td><?php echo $maskedCard; ?></td>
											<td><?php echo str_repeat('*', strlen($row['CVV'])); ?></td>
											<td><?php echo date('d-m-Y H:i', strtotime($row['PaymentDate'])); ?></td>
											<td>
												<a href="all-payments.php?delid=<?php echo $row['ID']; ?>" 
												   class="btn btn-danger btn-sm"
												   onclick="return confirm('Are you sure you want to delete this payment record?');">
													Delete
												</a>
											</td>
										</tr>
										<?php
										$cnt++;
									}
								} else {
									?>
									<tr>
										<td colspan="9" class="text-center">No payment records found</td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
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
