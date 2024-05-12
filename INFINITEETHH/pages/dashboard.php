<?php
session_start();

if (!isset($_SESSION['UserLogin'])) {
    header('Location: appointment.php');
    exit();
}

if (isset($_SESSION['PatientID'])) {
    $patientID = $_SESSION['PatientID'];
}

if (isset($_GET['logout'])) {
    $_SESSION = array();

    session_destroy();

    header("Location: login.php");
    exit;
}

$_SESSION['email'] = $_SESSION['UserLogin'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Clinic Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .navbar-brand img {
            width: 100px;
            margin-right: 5px;
        }
       
        div.appointment {
    background-color: #fff;
    padding: 50px;
}

div.appointment a.btn.btn-primary {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

div.appointment a.btn.btn-primary:hover {
    background-color: #0056b3;
}

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logooo-removebg-preview.png" alt="Dental Clinic Logo" class="d-inline-block align-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
                <div class="offcanvas-header">
                    <h1 class="offcanvas-title">Dental Clinic Dashboard</h1>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="margin-top: 30px;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="prof.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dentist.php">Dentists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="appointment.php">Appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="record.php">Records</a>
                        </li>
                        <li class="nav-item logout-btn">
                            <a class="nav-link" href="dashboard.php?logout=true">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    
        <div class="container">


        <div class="appointment">
            <h2>Appointments</h2>
            <p>View your upcoming appointments or book a new appointment.</p>
            <a href="appointment.php" class="btn btn-primary">Book an Appointment</a>
        </div>

        <div class="dentist">
            <h2>Meet Our Dentists</h2>
            <p>Meet our experienced dentists and schedule an appointment.</p>
        </div>

        <div class="aboutus">
            <h2>About Us</h2>
            <p>Learn more about our dental clinic and services.</p>
        </div>
        </div>
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
