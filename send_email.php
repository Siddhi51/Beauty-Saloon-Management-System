<?php
    session_start();

    error_reporting(0);
    include('includes/dbconnection.php');
    if (strlen($_SESSION['bpmsuid']==0)) {
    header('location:logout.php');
    }
    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 0); // Disable display errors to prevent HTML output

    // Set header to JSON
    header('Content-Type: application/json');

    // Initialize response array
    $response = array();

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "beauty");

    if (!$conn) {
        $response['success'] = false;
        $response['message'] = "Database connection failed: " . mysqli_connect_error();
        echo json_encode($response);
        exit;
    }

    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate incoming data
    if (!isset($data['name']) || !isset($data['email']) || !isset($data['service']) || !isset($data['amount'])) {
        $response['success'] = false;
        $response['message'] = 'Missing required data';
        echo json_encode($response);
        exit;
    }

    // Extract the data
    $username = mysqli_real_escape_string($conn, $data['name']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $amount = mysqli_real_escape_string($conn, $data['amount']);
    $service = mysqli_real_escape_string($conn, $data['service']);
    $card_number = mysqli_real_escape_string($conn, $data['cardNumber']);
    $exp_date = mysqli_real_escape_string($conn, $data['expiryDate']);
    $cvv = mysqli_real_escape_string($conn, $data['cvv']);

    // Insert into tblpayment
    $sql = "INSERT INTO tblpayment (username, email, amount, card_number, exp_date, cvv) 
            VALUES ('$username', '$email', '$amount', '$card_number', '$exp_date', '$cvv')";

    if (mysqli_query($conn, $sql)) {
        $response['success'] = true;
        $response['message'] = "Payment recorded successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Error: " . mysqli_error($conn);
        echo json_encode($response);
        exit;
    }

    mysqli_close($conn);

    // Sanitize input data
    $name = htmlspecialchars(strip_tags($data['name']));
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $service = htmlspecialchars(strip_tags($data['service']));
    $amount = htmlspecialchars(strip_tags($data['amount']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['success'] = false;
        $response['message'] = 'Invalid email address';
        echo json_encode($response);
        exit;
    }

    // Define PHPMailer path correctly
    $phpmailerPath = realpath(__DIR__ . '../PHPMailer_master/src') . '/';

    // Debugging: Check if PHPMailer path exists
    if (!is_dir($phpmailerPath)) {
        $response['success'] = false;
        $response['message'] = 'PHPMailer path not found!';
        $response['phpmailerPath'] = $phpmailerPath;
        echo json_encode($response);
        exit;
    }

    // Require PHPMailer files
    require_once $phpmailerPath . 'PHPMailer.php';
    require_once $phpmailerPath . 'SMTP.php';
    require_once $phpmailerPath . 'Exception.php';

    // Use PHPMailer namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    try {
        // Initialize the PHPMailer object
        $mail = new PHPMailer(true);
        
        $mail->isSMTP(); 
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true; 
        $mail->Username = 'farmstayhub21@gmail.com'; 
        $mail->Password = 'xzbv hufo fimo usnx'; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587; 

        //Recipients
        $mail->setFrom('beautysalon21@yopmail.com', 'Beauty Salon');
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(true); 
        
        $mail->Subject = "Beauty Salon Service Booking Confirmation";
        $mail->Body = "
        <html>
        <body style='font-family: Arial, sans-serif;'>
            <h2>Dear $name,</h2>
            <p>Thank you for booking our services at Beauty Salon.</p>
            <h3>Booking Details:</h3>
            <ul>
                <li>Service: $service</li>
                <li>Amount: $amount</li>
            </ul>
            <p>We look forward to serving you!</p>
            <br>
            <p>Best regards,<br>Beauty Salon Team</p>
        </body>
        </html>
        ";

        $mail->AltBody = "
        Dear $name,

        Thank you for booking our services at Beauty Salon.

        Booking Details:
        - Service: $service
        - Amount: $amount

        We look forward to serving you!

        Best regards,
        Beauty Salon Team
        ";

        // Send Email
        if ($mail->send()) {
            $response['success'] = true;
            $response['message'] = 'Payment recorded and email sent successfully';
        } else {
            $response['success'] = false;
            $response['message'] = 'Failed to send email: ' . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        $response['success'] = false;
        $response['message'] = "Failed to send email. Error: " . $e->getMessage();
    }

    // Send final response
    echo json_encode($response);
    ?>
