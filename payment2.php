<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Parlour Payment</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>
<style>
    /* Basic styles for the beauty parlour payment page */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
    text-align: center;
    max-width: 400px;
    width: 100%;
}

h1 {
    font-size: 24px;
    color: #333;
}

.payment-details h2 {
    color: #28a745;
    font-size: 22px;
    margin: 20px 0;
}

.note p {
    font-size: 14px;
    color: #777;
    margin-top: 20px;
}

#qrcode {
    margin-top: 20px;
    display: inline-block;
    border: 1px solid #ddd;
    padding: 15px;
}

</style>
<body>

    <div class="container">
        <h1>Beauty Parlour Payment</h1>
        <p>Please make your payment by scanning the QR code below.</p>
        
        <div id="qrcode"></div>

        <div class="payment-details">
            <!-- <h2>Total: $50.00</h2> -->
            <p>Payment Method: QR Code (Scan to Pay)</p>
        </div>

        <div class="note">
            <p>Ensure that the amount is correct before making the payment.</p>
        </div>

    </div>

    <script>
        // Generate QR code dynamically with the payment details
        const paymentLink = 'https://example-payment-link.com?amount=50.00&service=beauty';  // Replace with real payment link
        const qrcode = new QRCode(document.getElementById("qrcode"), {
            text: paymentLink,
            width: 128,
            height: 128,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    </script>

</body>
</html>
