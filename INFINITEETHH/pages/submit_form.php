<?php

include 'connection.php'; // Include the file where the connection function is defined

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $conn = connection();

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO appointment (Fullname, Datetime, Dentist, Services) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $datetime, $dentist, $services);

    // Set parameters and execute
    $fullname = $_POST["fullname"];
    $datetime = $_POST["datetime"];
    $dentist = $_POST["dentist"];
    $services = $_POST["services"];

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
