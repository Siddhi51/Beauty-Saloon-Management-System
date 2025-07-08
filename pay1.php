<?php
include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Donate</title>

    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
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
            background-color: light orange;
        }

        .donate1 {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            width: 100%;

        }

        .donate2 {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            height: 320px;

        }

        .donate1:hover {
            box-shadow: 0 0 2px 1px rgba(218, 91, 7, 0.5);
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
            background-color: #4CAF50;
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
            color: red;
            cursor: pointer;
        }

        .d {
            margin-left: 55px;
            margin-top: -50px;
            border-radius: 20px;
            padding: 20px;
            color: white;
            background-color: blue;
        }
    </style>
    <script>
        // Function to open the dialog box
        function openDialog() {
            document.getElementById("dialog-box").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        // Function to close the dialog box
        function closeDialog() {
            document.getElementById("dialog-box").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
    </script>
</head>

<body>
    <div>
        <?php include 'navbar.php' ?>
    </div>
    <div class="row-1">
        <div class="hero-image">
            <div class="hero-text">
                <h1 style="font-size:40px;font-weight: bolder;">DONATE</h1>
            </div>
        </div>
    </div>

    <div class="donate" style="margin-left: 4%;margin-top: 4%;margin-right: 4%;">


        <div class="row">
            <div class="col-md-8">
                <div class="container">
                    <div class="row donate1">
                        <div class="col-md-6"><img src="Images\money.jpg" alt="" style="height:95%;width:95%"></div>
                        <div class="col-md-6" style="padding-left:10%; padding-top: 7%;">
                            <h3 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">DONATIONS</h3>
                            <p style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight: bold;">If you like to donate, Click Below.</p>


                            <div id="thank-you-message">
                                <button class="button " onclick="openDialog()" style="height: 30%; width: 50%; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-weight: bold; background-color: orangered;border: solid; margin-top: 5%;border-radius: 10px;">Donate </button>
                            </div>

                            <div id="dialog-box" class="dialog-box">
                                <span class="close-icon" onclick="closeDialog()">&times;</span>
                                <img src="Images\WhatsApp Image 2024-03-05 at 10.41.56_b26564a1.jpg" alt="QR code" style="height:100%; width: 100%;">
                                <a href="/Animal Rescue Services/stripe/index.php"><button class="d">For Donation With Debit/Credit Card</button></a>
                            </div>
                            <div id="overlay" class="overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 donate1">
                <div class="col">
                    <div class="row">
                        <div class="col-md-4" style=" text-align: start; color:grey;font-weight: bolder;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                            <h3>62M</h3>
                        </div>
                        <div class="col-md-8">
                            <p style="font-weight: bold;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;text-align:justify;">stray dogs living on India’s streets</p>
                        </div>
                    </div>
                </div><br>

                <div class="col">
                    <div class="row">
                        <div class="col-md-4" style=" text-align: start; color:green;font-weight: bolder;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                            <h3>9.1M</h3>
                        </div>
                        <div class="col-md-8">
                            <p style="font-weight: bold;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;text-align:justify;"> stray homeless cats in India</p>
                        </div>
                    </div>

                </div><br><br>


                <div class="col">
                    <div class="row">
                        <div class="col-md-4" style=" text-align: start; color:rgb(228, 102, 56);font-weight: bolder;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                            <h3>62M</h3>
                        </div>
                        <div class="col-md-8">
                            <p style="font-weight: bold;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;text-align:justify;">strays in shelters, and quickly running out of space</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div><br><br>
    <div class="donate" style="margin-left: 4%;margin-top: 4%;margin-right: 4%;">
        <div class="row">
            <div class="col-md-8">
                <div class="container">
                    <div class="row donate2">
                        <h3 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight: bold;padding-left: 3%;padding-top: 2%;">WHY DONATE</h3>
                        <p style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight: bold;padding-left: 3%;">Your donations directly affect the number of strays we are able to rescue, treat,<br> and shelter. Help SAFI make a difference in the lives of India’s animals. 100% of <br> contributions go to the rescue.</p>
                    </div>

                </div>

            </div>
            <div class="col-md-4 donate1">
                <img src="Images\istockphoto-1065400158-612x612.jpg" alt="img" style="width: 100%;">

            </div>
        </div>
    </div><br><br>

    <!-- <div class="row-1">
        <div class="hero-image">
            <div class="hero-text">
            </div>
        </div>
    </div> -->
    <div>
        <?php
        include 'footer.php';
        ?>
    </div>
</body>

</html>