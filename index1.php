<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "beauty");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create table if it doesn't exist
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
)";

if (!mysqli_query($conn, $createTable)) {
    die("Error creating table: " . mysqli_error($conn));
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $amount = mysqli_real_escape_string($conn, $_POST['numericAmount']);
    $cardNumber = mysqli_real_escape_string($conn, $_POST['cardNumber']);
    $expiryDate = mysqli_real_escape_string($conn, $_POST['expiryDate']);
    $cvv = mysqli_real_escape_string($conn, $_POST['cvv']);
    
    // Insert data into tblpayment with correct column names
    $sql = "INSERT INTO tblpayment (CustomerName, CustomerEmail, ServiceName, PaymentAmount, CardNumber, ExpiryDate, CVV) 
            VALUES ('$name', '$email', '$service', '$amount', '$cardNumber', '$expiryDate', '$cvv')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Payment recorded successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><link rel="stylesheet" href="../assets/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Parlour Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:rgb(244, 244, 249);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
        }
        .payment-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
          
            width: 400px;
            width: 13cm;
            position: relative;
            border-radius: 40px;
        }
        
        h2 {
            text-align: center;
            color:hotpink;
        }
        .input-field {
            margin-bottom: 15px;
            width: 100%;
            
        }
       
        .input-field input {
            width: 100%;
            padding: 10px;
            border: 1px solid indigo;
            border-radius: 5px;
        }
        .input-field label {
            font-size: 14px;
            color:black;
            margin-bottom: 5px;
            display: block;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color:rgb(89, 58, 230);
            color: white;
            border: 2px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color:rgb(21, 33, 123);
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
            box-sizing: border-box;
        }
        .success {
            color: green;
            font-size: 16px;
            margin-top: 10px;
            text-align: center;
        }
        .logout-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff4757;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #e84118;
        }
        a {
    display: block;
    text-align: left;
    font-size: 14px;
    margin-bottom: 10px;
    color:rgb(234, 69, 160);
    text-decoration: none;
    font-family: Arial, Helvetica, sans-serif;
    font-size: large;
}

a:hover {
    text-decoration: none;
    color:rgb(105, 31, 94);
}
    </style>
</head>
<body style="background-color:white;">

<div class="payment-container" >
  <a href="index.php" >Back</a>
  <b><h2 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Beauty salon service Payment</h2></b>
    <form id="paymentForm" method="POST" action="">
        <div class="input-field">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-field">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-field">
            <label for="service">Select Service</label>
            <select id="service" name="service" required style="width: 13.3cm; height: 1cm;">
                <option value="facial">Facial</option>
                <option value="hairStyle">HairStyle</option>
                <option value="Manicure & Pedicure">Manicure & Pedicure</option>
                <option value="Makeup For Sider">Makeup For Sider</option>
                <option value="Makeup For Bride">Makeup For Bride</option>
                <option value="HairSpa">HairSpa</option>
                <option value="Fruit Facial">Fruit Facial</option>
                <option value="Eye Brow">Eye Brow</option>
                <option value="Nail Art">Nail Art</option>
            </select>
        </div>
        <div class="input-field">
            <label for="amount">Amount to Pay</label>
            <input type="text" id="amount" name="amount" readonly>
            <input type="hidden" id="numericAmount" name="numericAmount">
        </div>
        <div class="input-field">
            <label for="cardNumber">Card Number</label>
            <input type="text" id="cardNumber" name="cardNumber" placeholder="Enter your card number" required>
        </div>
        <div class="input-field">
            <label for="expiryDate">Expiry Date</label>
            <input type="date" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
        </div>
        <div class="input-field">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" required>
        </div>
        <button type="submit" class="submit-btn">Pay Now</button>
    </form>
    <div class="error" id="errorMessage"></div>
    <div class="success" id="successMessage" style="display: none;"></div>
</div>

<script>
    const servicePrices = {
        "facial": 500,
        "hairStyle": 700,
        "Manicure & Pedicure": 2000,
        "Makeup For Sider": 1500,
        "Makeup For Bride":3000,
        "HairSpa":300,
        "Fruit Facial":1000,
        "Eye Brow":50,
        "Nail Art":300
    };

    // Update the amount when a service is selected
    document.getElementById('service').addEventListener('change', function () {
        const service = this.value;
        const amount = servicePrices[service];
        document.getElementById('amount').value = "₹" + amount;
        document.getElementById('numericAmount').value = amount;
    });

    // Set initial amount based on default selection
    window.onload = function() {
        const defaultService = document.getElementById('service').value;
        if(defaultService) {
            const amount = servicePrices[defaultService];
            document.getElementById('amount').value = "₹" + amount;
            document.getElementById('numericAmount').value = amount;
        }
    };

    // Handle form submission
    document.getElementById('paymentForm').addEventListener('submit', function (e) {
        // Get form data
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const service = document.getElementById('service').value;
        const amount = document.getElementById('numericAmount').value;
        const cardNumber = document.getElementById('cardNumber').value;
        const expiryDate = document.getElementById('expiryDate').value;
        const cvv = document.getElementById('cvv').value;

        // Simple validation (can be extended)
        if (!name || !email || !service || !amount || !cardNumber || !expiryDate || !cvv) {
            e.preventDefault(); // Prevent form submission
            document.getElementById('errorMessage').textContent = "Please fill in all fields correctly!";
            return;
        }
    });
</script>

</body>
</html>