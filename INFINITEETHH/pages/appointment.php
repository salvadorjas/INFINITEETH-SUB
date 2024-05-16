<?php
session_start();
include '../connection/connection.php';

$conn = connection();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rows = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO pendingappointments (patient_PatientID, Client_Name, Services, Dentist, Day, TIme, Status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('issssss', $patientID, $Client_Name, $Services, $Dentist, $Day, $Time, $Status);


    
$Time = isset($_POST["Time"]) ? $_POST["Time"] : '';
$timeObj = DateTime::createFromFormat('h:i A', $Time);
if (!$timeObj) {
    $timeObj = DateTime::createFromFormat('H:i', $Time);
}
if (!$timeObj) {
    echo "Invalid time format";
}
$Time = $timeObj->format('H:i');

    

    $patientID = isset($_SESSION["PatientID"]) ? $_SESSION["PatientID"] : '';
    $Client_Name = isset($_POST["Client_Name"]) ? $_POST["Client_Name"] : '';
    $Services = isset($_POST["services"]) ? $_POST["services"] : '';
    $Dentist = isset($_POST["dentist"]) ? $_POST["dentist"] : '';
    $Day = isset($_POST["Day"]) ? $_POST["Day"] : '';
    $Status = "Pending";
    
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}


if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
    exit;
}

$patientID = isset($_SESSION["PatientID"]) ? $_SESSION["PatientID"] : '';
$result = $conn->query("SELECT PendingID, Client_Name, Services, Dentist, Day, Time, Status FROM pendingappointments WHERE patient_PatientID = $patientID");



if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-image: url(estitik.jpg);
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: black;
        }

        .navbar-brand img {
            width: 100px;
            margin-right: 5px;
        }

        .navbar-brand {
            font-size: 20px;
            color: white !important;
        }

        .offcanvas-body {
            color: white;
        }

        .container-box {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            padding: 50px;
            margin-top: 150px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-label {
            color: white;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            border-radius: 5px;
        }
        .nav-link{
            color: white;
        }

        #appointmentForm {
            margin-top: 100px;
        }

     
      
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="logooo-removebg-preview.png" alt="Logo" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bg-white"></span>
        </button>
        <div class="offcanvas offcanvas-end bg-black" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Infiniteeth</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="margin-top: 30px;">
                    <li class="nav-item" style="margin-right: 65px;">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item" style="margin-right: 65px;">
                        <a class="nav-link" href="appointment.php?logout=true">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<form method="post" action="" id="appointmentForm">
    <div class="container">
<div class="row justify-content-center">
            <div class="container-box">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="Client_Name" name="Client_Name" placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                    <label for="services" class="form-label">Services</label>
                    <select class="form-select" id="services" aria-label="Select Services" name="services">
                        <option selected disabled>Select Services</option>
                        <option value="Dental Implants">Dental Implants</option>
                        <option value="Root Canal and Filling">Root Canal and Filling</option>
                        <option value="Crowns and Bridges">Crowns and Bridges</option>
                        <option value="Tooth Extraction">Tooth Extraction</option>
                        <option value="Invisalign">Invisalign</option>
                        <option value="Teeth Whitening">Teeth Whitening</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dentist" class="form-label">Dentist</label>
                    <select class="form-select" id="dentist" aria-label="Select Dentist" name="dentist">
                        <option selected disabled>Select Dentist</option>
                        <option value="Dr. Cram Banzal">Dr. Cram Banzal</option>
                        <option value="Dr. Leigh Gegrimos">Dr. Leigh Gegrimos</option>
                        <option value="Dr. Leily Derramas">Dr. Leily Derramas</option>
                        <option value="Dr. Lovely Gallamos">Dr. Lovely Gallamos</option>
                        <option value="Dr. Justin Salvador">Dr. Justin Salvador</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inputDate" class="form-label">Day</label>
                        <input type="date" name="Day" class="form-control" id="Day" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputTime" class="form-label">Time</label>
                        <input type="time" name="Time" class="form-control" id="Time" required>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Appoint</button>
            </div>
        </div>
    </div>
</form>



<?php 
if (isset($_SESSION['PatientID'])) {
    $patientID = $_SESSION['PatientID'];
    echo "<p id='patientID'>Patient ID: $patientID</p>";
}
?>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Appointment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to appoint this schedule?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="confirmAppointment()">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function confirmAppointment() {
        alert("Schedule for your appointment has been confirmed!");
        document.getElementById("appointmentForm").submit();
    }
</script>

</body>
</html>
