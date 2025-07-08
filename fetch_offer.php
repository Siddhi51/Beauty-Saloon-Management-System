
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        h3{
           color:coral;
        }
        h2{
            color:deeppink;
        }
        .offer-container{

            width: 90%;
            display: grid;
            grid-template-columns: repeat(3, minmax(250px, 1fr));
            gap: 20px;
        }
        .offer-card p {
            color: #555;
            margin: 5px 0;
        }
       
        .offer-card h3 {
            color: #d63384;
            margin: 10px 0;
        }
        .offer-card p {
            color: #555;
            margin: 5px 0;
        }
        .offer-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        

        .book
        {
            
            background-color: #f03c8d; 
        
            color: white;
            border: none;
            padding: 10px;
            width: 60%;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            line-height: 20px;
            border: 3px solid #f567a6; ;
        }
        .book:hover{
            background-color:rgb(91, 42, 66);
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Salon Offers</title>
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("offers.php")
                .then(response => response.json())
                .then(data => {
                    const offerContainer = document.querySelector(".offer-container");
                    offerContainer.innerHTML = ""; // Clear existing content
                    data.forEach(offer => {
                        const offerCard = document.createElement("div");
                        offerCard.classList.add("offer-card");
                        offerCard.innerHTML = `<br><br><br>
                            <div class="service-card">
                          <center><h3> book now valid only few day..! </h3></center>
                            <h2>${offer.title}</h2><br>
                            <p>${offer.description}</p><br>
                            <button class="book"><a href="book-appointment.php"><span class="price"style="color:white;" >${offer.price}</span><a></button>
                            </div>
                        `;
                        offerContainer.appendChild(offerCard);
                    });
                })
                .catch(error => console.error("Error loading offers:", error));
        });
    </script>
</head>
<center><body id="home">

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
<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
} 

</script>
<!-- disable body scroll which navbar is in active -->

<!-- breadcrumbs -->
<section class="w3l-inner-banner-main">
    <div class="about-inner contact ">
        <div class="container">   
            <div class="main-titles-head text-center">
            <h3 class="header-name ">
                
             SALON OFFERS
            </h3>
            <p class="tiltle-para ">Exclusive Beauty Salon Offers!</p>
        </div>
</div>
</div>
<div class="breadcrumbs-sub">
<div class="container">   
<ul class="breadcrumbs-custom-path">
    <li class="right-side propClone"><a href="index.php" class="">Home <span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
    <li class="active ">
        Offers</li>
</ul>
</div>
</div>
    </div>
</section>

    
<section class="w3l-contact-info-main" id="contact"></section>
<div class="contact-sec	">
        <div class="container">

            <div class="d-grid contact-view">
                <div class="cont-details">
                <div class="service-card">        
            <div class="offer-container">
           <h2> Exclusive Beauty Salon Offers!</h2>
            <!-- Offers will be loaded dynamically from MySQL -->
        </div>
    </div>
</div>
            </div>      
    </div>        
    </section>
    </div>
    
    <script>
        document.querySelectorAll(".add-to-cart").forEach(button => {
            button.addEventListener("click", function() {
                alert("Service added to cart!");
            });
        });
    </script>
</body></center><br><br>
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
</script>
<!-- /move top -->
</body></center>


</html>
