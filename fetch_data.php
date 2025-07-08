<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');



$result = $conn->query("SELECT * FROM payments");

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Service</th>
                <th>Amount</th>
                <th>Payment Date</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['customer_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['service']}</td>
                <td>{$row['amount']}</td>
                <td>{$row['payment_date']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No payments found.";
}

$conn->close();
?>
