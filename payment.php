<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsuid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {
    $uid=$_SESSION['bpmsuid'];
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $query=mysqli_query($con, "update tbluser set FirstName='$fname', LastName='$lname' where ID='$uid'");

  }
    if ($query) {
 echo '<script>alert("Profile updated successully.")</script>';
echo '<script>window.location.href=profile.php</script>';
  }
  else
    {
     
      //    echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }

}


  ?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Review & Rating System in PHP & Mysql using Ajax</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

  
    <link rel="stylesheet" href="assets/css/style-starter.css">
     <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet"> 
    <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet"> -->
    <title>Payment</title>

<style>
   
    .sticky-header{
    position: fixed;
    top: 0;
    left:0px;
    width: 100%;
    z-index: 100;
}
.header-section {
    background:#FFF;
    box-shadow:  1px 1px 4px rgba(0, 0, 0, 0.21);
    -webkit-box-shadow:  1px 1px 4px rgba(0, 0, 0, 0.21);
    -moz-box-shadow:  1px 1px 4px rgba(0, 0, 0, 0.21);
    -o-box-shadow:  1px 1px 4px rgba(0, 0, 0, 0.21);
}
.header-section::after {
    clear: both;
    display: block;
    content: '';
}
.header-left {
    float: left;
    width: 45%;
}
.header-right {
    float: right;
}
.dialog-box{
height: 30%;
    width: 50%;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-weight: bold;
    background-color: white;
    border: solid;
    margin-top: 5%;
    border-radius: 10px;
}
.hero-image {
            background-image: linear-gradient(rgba(5, 70, 39, 0.7), rgba(6, 82, 40, 0.7)), url("images/istockphoto-881028924-1024x1024.jpg");
            height: 250px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            max-width: 100%;
        }

        .hero-text {
            text-align: center;
            align-content: center;
            padding-top: 12%;

            color: white;
            padding-left: 6%;


        }

        .donate .button:hover {
            background-color: light  blue;
        }

        .donate1 {
            border: 1px solid rgba(41, 156, 213, 0.5);
            border-radius: 40px;
            padding: 10px;
            width: 150%;
            height: 100%;

        }

        .donate2 {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            height: 320px;

        }

        .donate1:hover {
            box-shadow: 0 0 2px 1px rgba(6, 70, 247, 0.5);
        
        }

        .donate2:hover {
            box-shadow: 0 0 2px 1px rgba(218, 91, 7, 0.5);
        }

        .dialog-box {
            display: none;
            position: fixed;
            height: 450px;
            width: 450px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 9999;

        }

        /* Style for the button */
        .button {
            background-color:rgb(46, 23, 219);
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        /* Style for the overlay */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            /* Adding blur effect */
            z-index: 998;
            /* Ensure it's behind the dialog */
        }

        .close-icon {
            position: absolute;
            top: 7px;
            right: 7px;
            size: 50px;
            color:lightskyblueblue;
            cursor: pointer;
        }

        .d {
            margin-left: 5px;
            margin-top: 1px;
            border-radius: 20px;
            padding:10px;
            color: white;
            background-color:darkblue ;
        }
       .a{
        background-color: red;
       }
</style>

</head>


    
<body>
    
    <?php include_once('includes/header.php');?>
    
    <!-- breadcrumbs -->
    <section class="w3l-inner-banner-main">
        <div class="about-inner services ">
            <div class="container">   
                <div class="main-titles-head text-center">
                <h3 class="header-name ">
              Payment
                </h3>
            </div>
    </div>
    </div>
    <div class="breadcrumbs-sub">
    <div class="container">   
    <ul class="breadcrumbs-custom-path">
        <li class="right-side propClone"><a href="index.php" class="">Home <span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
        <li class="active ">Payment</li>
    </ul>
    </div>
    </div>
        </div>
    </section>


    <div class="donate" style="margin-left: 10%;margin-top: 4%;margin-right:10%;">


        <div class="row">
        
            <div class="col-md-8">
                <div class="container">
                    <div class="row donate1">
                        <div class="col-md-7"><img src="https://blog.2checkout.com/wp-content/uploads/2020/07/online-payment-gateway.png" alt="" style="height:100%;width:100%"></div>
                        <div class="col-md-5" style="padding-left:10%; padding-top: 7%;">
                            <h3 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">PAYMENT</h3>
                            <p style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight: bold;">If you like to Advance Payment, Click Below.</p>

                               <img src="https://img.icons8.com/?size=96&id=w0MU3YDSYG7T&format=png"style="height:1cm; width: 1cm;">  <img src="https://img.icons8.com/?size=96&id=68067&format=png"style="height:1cm; width: 1cm;">  <img src="https://img.icons8.com/?size=80&id=41013&format=png"style="height:1cm; width: 1cm;">  <img src="https://img.icons8.com/?size=160&id=Wsm4NDaTCxsy&format=png"style="height:1cm; width: 1cm;">
                            <div id="thank-you-message">
                                <span class="close-icon" onclick="closeDialog()">&times;</span>
                                <button class="button " onclick="openDialog()" style="height: 40%; width: 60%; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-weight: bold; background-color:darkblue;border: solid; margin-top: 5%;border-radius: 10px; color:white;">
                                <!-- <a href= \Beauty1\bpms\assets\images\WhatsApp Image 2025-02-24 at 5.06.34 PM.jpeg alt="QR code" style="height:100%; width: 100%;"> -->
                                  <a href="payment2.php">
                                    Payment </button>
                            </div>
                         <br><br><br>
                         
                         
                              

                             <a href="index1.php"><button class="d" style="height:2.5cm; width:6cm">For payment With Debit/Credit Card</button>                </div></button>  
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- <div class="col-md-4 donate1">
                <div class="col">
                    <div class="row"> -->
                        <!-- <div class="col-md-4" style=" text-align: start; color:grey;font-weight: bolder;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                            <h3>62M</h3> -->
                        <!-- </div> -->
                        <!-- <div class="col-md-8">
                            <p style="font-weight: bold;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;text-align:justify;">stray dogs living on India’s streets</p>
                        </div> -->
                    </div>
                </div><br>

                <div class="col">
                    <!-- <div class="row">
                        <div class="col-md-4" style=" text-align: start; color:green;font-weight: bolder;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                            <h3>9.1M</h3>
                        </div> -->
                        <!-- <div class="col-md-8">
                            <p style="font-weight: bold;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;text-align:justify;"> stray homeless cats in India</p>
                        </div> -->
                    </div>

                </div><br><br>


                <!-- <div class="col">
                    <div class="row">
                        <div class="col-md-4" style=" text-align: start; color:rgb(228, 102, 56);font-weight: bolder;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                            <h3>62M</h3>
                        </div>
                        <div class="col-md-8">
                            <p style="font-weight: bold;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;text-align:justify;">strays in shelters, and quickly running out of space</p>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>

        </div><br><br>
    <div class="Payment" style="margin-left: 4%;margin-top: 4%;margin-right: 4%;">
        <div class="row">
            <div class="col-md-8">
                <div class="container">
                    <!-- <div class="row donate2">
                        <h3 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight: bold;padding-left: 3%;padding-top: 2%;">WHY DONATE</h3>
                        <p style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight: bold;padding-left: 3%;">Your donations directly affect the number of strays we are able to rescue, treat,<br> and shelter. Help SAFI make a difference in the lives of India’s animals. 100% of <br> contributions go to the rescue.</p>
                    </div> -->

                </div>

            </div>
            <!-- <div class="col-md-4 donate1">
                <img src="Images\istockphoto-1065400158-612x612.jpg" alt="img" style="width: 100%;">

            </div> -->
        </div>
    </div><br><br>

    <div>
    <?php include_once('includes/footer.php');?>

    </div>
</body>

</html>

