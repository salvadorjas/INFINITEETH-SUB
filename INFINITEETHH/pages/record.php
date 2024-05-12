<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page or display a message
    header("Location: login.php");
    exit;
}

// Include database connection
include('../connection/connection.php');
$conn = connection();

// Get user's email
$email = $_SESSION['email'];

// Retrieve user's appointments
$sql = "SELECT * FROM appointments WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if appointments exist
if ($result->num_rows > 0) {
    // Display appointments
    while ($row = $result->fetch_assoc()) {
        echo "<p>Appointment Date: " . $row['appointment_date'] . "</p>";
        // Add more appointment details as needed
    }
} else {
    echo "<p>No appointments found.</p>";
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECORDS</title>
</head>
<body>
    
</body>
</html>