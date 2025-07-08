<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsuid']==0)) {
  header('location:logout.php');
  } else{

    if (isset($_POST['submit'])) {
        $uid = $_SESSION['bpmsuid'];
        $adate = $_POST['adate'];
        $atime = $_POST['atime'];
        $msg = $_POST['message'];
        $aptnumber = mt_rand(100000000, 999999999);
        $services = isset($_POST['services']) ? $_POST['services'] : []; // Array of selected services
    
        $totalAmount = 0; // Initialize total amount
    
        if (!empty($services)) {
            $serviceIDs = implode(',', array_map('intval', $services)); // Convert array to comma-separated string
            
            // Calculate total cost
            $query = mysqli_query($con, "SELECT SUM(Cost) AS total FROM tblservices WHERE ID IN ($serviceIDs)");
            $result = mysqli_fetch_assoc($query);
            $totalAmount = $result['total']; // Get total cost
        } else {
            $serviceIDs = NULL; // No services selected
        }
    
        // Insert into tblbook with service IDs as a comma-separated string
        $query = mysqli_query($con, "INSERT INTO tblbook (UserID, AptNumber, AptDate, AptTime, Message, TotalAmount, Services) 
                                     VALUES ('$uid', '$aptnumber', '$adate', '$atime', '$msg', '$totalAmount', '$serviceIDs')");
    
        if ($query) {
            $_SESSION['aptno'] = $aptnumber;
            echo "<script>window.location.href='thank-you.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
    

    
?>
<!doctype html>
<html lang="en">
  <head>
 

    <title>Beauty Parlour Management System | Appointment Page</title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        input[type="checkbox"] {
            cursor: pointer;
            appearance: auto; /* Ensures default checkbox rendering */
        }
        label {
            cursor: pointer;
        }
    </style>
  </head>
  <body id="home">
<?php include_once('includes/header.php');?>

<script src="assets/js/jquery-3.3.1.min.js"></script> <!-- Common jquery plugin -->
<!--bootstrap working-->
<script src="assets/js/bootstrap.min.js"></script>
<!-- //bootstrap working-->
<!-- disable body scroll which navbar is in active -->
<script>
$(function () {
  $('.navbar-toggler').click(function () {
    $('body').toggleClass('noscroll');
  })
});
</script>
<!-- disable body scroll which navbar is in active -->

<!-- breadcrumbs -->
<section class="w3l-inner-banner-main">
    <div class="about-inner contact ">
        <div class="container">   
            <div class="main-titles-head text-center">
            <h3 class="header-name ">
                
 Book Appointment
            </h3>
            <p class="tiltle-para ">If you want to book any appointment, then fill this and get booked appointments.</p>
        </div>
</div>
</div>
<div class="breadcrumbs-sub">
<div class="container">   
<ul class="breadcrumbs-custom-path">
    <li class="right-side propClone"><a href="index.php" class="">Home <span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
    <li class="active ">
        Book Appointment</li>
</ul>
</div>
</div>
    </div>
</section>
<!-- breadcrumbs //-->
<section class="w3l-contact-info-main" id="contact">
    <div class="contact-sec	">
        <div class="container">
            <div class="d-grid contact-view">
                <div class="cont-details">
                    <?php
                        $ret=mysqli_query($con,"select * from tblpage where PageType='contactus' ");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($ret)) {

                        ?>
                    <div class="cont-top">
                        <div class="cont-left text-center">
                            <span class="fa fa-phone text-primary"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Call Us</h6>
                            <p class="para"><a href="tel:+44 99 555 42">+<?php  echo $row['MobileNumber'];?></a></p>
                        </div>
                    </div>
                    <div class="cont-top margin-up">
                        <div class="cont-left text-center">
                            <span class="fa fa-envelope-o text-primary"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Email Us</h6>
                            <p class="para"><a href="mailto:example@mail.com" class="mail"><?php  echo $row['Email'];?></a></p>
                        </div>
                    </div>
                    <div class="cont-top margin-up">
                        <div class="cont-left text-center">
                            <span class="fa fa-map-marker text-primary"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Address</h6>
                            <p class="para"> <?php  echo $row['PageDescription'];?></p>
                        </div>
                    </div>
                    <div class="cont-top margin-up">
                        <div class="cont-left text-center">
                            <span class="fa fa-clock-o text-primary"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Time</h6>
                            <p class="para"> <?php  echo $row['Timing'];?></p>
                        </div>
                    </div>
               <?php } ?> </div>
                <div class="map-content-9 mt-lg-0 mt-4">
                <form method="post">
    <div style="padding-top: 30px;">
        <label>Appointment Date</label>
        <input type="date" class="form-control appointment_date" name="adate" id="adate" required>
    </div>

    <div style="padding-top: 30px;">
        <label>Appointment Time</label>
        <input type="time" class="form-control appointment_time" min="10:30" max="19:30" name="atime" id="atime" required>
    </div>

    <div style="padding-top: 30px;">
        <label style="font-weight: bold; font-size: 18px;">Select Services</label>
        <div style="display: flex; flex-wrap: wrap; gap: 15px; padding-top: 10px;">
            <?php
            $query = mysqli_query($con, "SELECT * FROM tblservices");
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <div style="width: 48%; display: flex; align-items: center; gap: 10px; background: #f8f9fa; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
                    <input type="checkbox" name="services[]" value="<?php echo $row['ID']; ?>" style="width: 18px; height: 18px;">
                    <label style="font-size: 16px; color: #333;"><?php echo $row['ServiceName']." ". $row['Cost'] . " /-" ; ?></label>
                </div>
            <?php } ?>
        </div>
    </div>

    <div style="padding-top: 30px;">
        <label>Additional Message</label>
        <textarea class="form-control" name="message" rows="4" placeholder="Any additional details..."></textarea>
    </div>

    <button type="submit" class="btn btn-contact" name="submit">Make an Appointment</button>
   
</form>

      </div>
    </div>
   
    </div></div>
</section>
<?php include_once('includes/footer.php');?>
<!-- move top -->
<button onclick="topFunction()" id="movetop" title="Go to top">
	<span class="fa fa-long-arrow-up"></span>
</button>
<script>
	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function () {
		scrollFunction()
	};

	function scrollFunction() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			document.getElementById("movetop").style.display = "block";
		} else {
			document.getElementById("movetop").style.display = "none";
		}
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('#adate').attr('min', maxDate);
});</script>
<!-- /move top -->
</body>

</html>
<?php } ?>