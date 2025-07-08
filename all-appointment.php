<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if($_GET['delid']){
$sid=$_GET['delid'];
$date=$_GET['date'];

mysqli_query($con,"delete from tblbook where ID ='$sid'");
echo "<script>alert('Data Deleted');</script>";
echo "<script>window.location.href='all-appointment.php'</script>";
          }

  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>BPMS || All Appointment</title>

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
					<h3 class="title1">All Appointment</h3>
					
					
					<div class="table-responsive bs-example widget-shadow">
								<div class="col-6">
									<h4>All Appointment:</h4>
								</div>
								<div class="col-6 text-right " >
									<form   method="POST" id="report_timesheet" >
										<input type="date" name="dateFrom"  value="<?php echo $_POST['dateFrom'] ?>" style="border: 1px solid #ccc ;margin-bottom:10px">
										<a href="#" class="btn btn-sm btn-primary"
											onclick="document.getElementById('report_timesheet').submit(); return false;">
											<span class="btn-inner--icon"> Apply<i class="ti ti-search"></i></span>
										</a>
										<a href="all-appointment.php" class="btn btn-sm btn-danger "
										>
										<span class="btn-inner--icon">Reset<i class="ti ti-trash-off text-white-off "></i></span>
										</a>
									</form>
								</div>
						<table class="table table-bordered"> <thead> <tr> <th>#</th> 
							<th> Appointment Number</th> 
							<th>Name</th><th>Mobile Number</th> 
							<th>Appointment Date</th>
							<th>Appointment Time</th>
							<th>Status</th>
							<th>Action</th> </tr> </thead> <tbody>
<?php
$new_date =$_POST['dateFrom'];

if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}  
$prev = $page - 1;
$next = $page + 1;
$results_per_page = 5;  
$page_first_result = ($page-1) * $results_per_page;  
$query = "select *from tblbook ";  
$result = mysqli_query($con,"select tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber,tblbook.ID as bid,tblbook.AptNumber,tblbook.AptDate,tblbook.AptTime,tblbook.Message,tblbook.BookingDate,tblbook.Status from tblbook join tbluser on tbluser.ID=tblbook.UserID ORDER BY tbluser.FirstName  ");  
$number_of_result = mysqli_num_rows($result);  
  
//determine the total number of pages available  
$number_of_page = ceil ($number_of_result / $results_per_page);  
if(!empty($new_date)){
	$ret=mysqli_query($con,"select tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber,tblbook.ID as bid,tblbook.AptNumber,tblbook.AptDate,tblbook.AptTime,tblbook.Message,tblbook.BookingDate,tblbook.Status from tblbook join tbluser on tbluser.ID=tblbook.UserID WHERE  tblbook.AptDate='$new_date' ORDER BY tbluser.FirstName LIMIT   $page_first_result ,  $results_per_page");
}else{
	// Perform Query
$ret=mysqli_query($con,"select tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber,tblbook.ID as bid,tblbook.AptNumber,tblbook.AptDate,tblbook.AptTime,tblbook.Message,tblbook.BookingDate,tblbook.Status from tblbook join tbluser on tbluser.ID=tblbook.UserID ORDER BY tbluser.FirstName  LIMIT   $page_first_result ,  $results_per_page");
}
$cnt=1;



while ($row=mysqli_fetch_array($ret)) {
	

?>

						 <tr> <th scope="row"><?php echo $cnt;?></th> 
						 	<td><?php  echo $row['AptNumber'];?></td> 
						 	<td><?php  echo $row['FirstName'];?> <?php  echo $row['LastName'];?></td>
						 	<td><?php  echo $row['MobileNumber'];?></td>
						 	<td><?php  echo $row['AptDate'];?></td> 
						 	<td><?php  echo $row['AptTime'];?></td>
						 	<?php if($row['Status']==""){ ?>

                     <td class="font-w600" style="color:orangered"><?php echo "Not Updated Yet"; ?></td>
                     <?php } else { ?>
                      <td  style="color: blue;"><?php  echo $row['Status'];?></td><?php } ?> 
                                       <td><a href="view-appointment.php?viewid=<?php echo $row['bid'];?>" class="btn btn-primary">View</a>
<a href="all-appointment.php?delid=<?php echo $row['bid'];?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                                       	</td> </tr>   
										   <?php 
$cnt=$cnt+1;
}
 ?></tbody> </table>
 <ul class="pagination justify-content-center">
        <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
            <a class="page-link"
                href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>">Previous</a>
        </li>
        <?php for($i = 1; $i <= $number_of_page; $i++ ): ?>
        <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
            <a class="page-link" href="all-appointment.php?page=<?= $i; ?>"> <?= $i; ?> </a>
        </li>
        <?php endfor; ?>
        <li class="page-item <?php if($page >= $number_of_page) { echo 'disabled'; } ?>">
            <a class="page-link"
                href="<?php if($page >= $number_of_page){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
        </li>
    </ul>

 
  
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