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
    $patientID = isset($_SESSION["PatientID"]) ? $_SESSION["PatientID"] : '';
    $Client_Name = isset($_POST["Client_Name"]) ? $_POST["Client_Name"] : '';
    $Services = isset($_POST["services"]) ? $_POST["services"] : '';
    $Dentist = isset($_POST["dentist"]) ? $_POST["dentist"] : '';
    $Day = isset($_POST["Day"]) ? $_POST["Day"] : '';
    $Time = isset($_POST["TIme"]) ? $_POST["TIme"] : '';
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
$result = $conn->query("SELECT PendingID, Client_Name, Services, Dentist, Day, TIme, Status FROM pendingappointments WHERE patient_PatientID = $patientID");


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
            background-image: url('infiBG.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: repeat;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: lightblue;
        }
        
        .navbar-brand img {
            width: 100px;
            margin-right: 5px;
        }

        .navbar-brand {
            font-size: 20px;
            color: white !important;
        }
        .offcanvas-body{
          color:black
        }
        .navbar-nav .nav-link {
            color: white !important;
        }

        .navbar-toggler {
            color: white !important;
        }

        .container-box {
            background-color: beige;
            border-radius: 10px;
            padding: 20px;
            margin-top: 150px;
            position: relative;
        }

        .form-group {
            margin-bottom: 20px;
        }
        .modal {
            z-index: 1100;
        }

        #patientID {
            color: white;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #191970; color: white;">
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
                <form class="d-flex mt-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</nav>
<form method="post" action="" id="appointmentForm">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="container-box" style="max-width: 500px;">
                <form method="post" action="">
                    <div class="mb-3 d-flex align-items-center">
                        <label for="fullname" class="form-label text-start me-3">Fullname</label>
                        <input type="text" class="form-control" id="Client_Name" name="Client_Name">
                    </div>
                    <div>
                        <legend class="form-label text-start">Services</legend>
                        <select class="form-select" aria-label="Default select example" name="services">
                            <option selected>Select Services</option>
                            <option value="Dental Implants">Dental Implants</option>
                            <option value="Root Canal and Filling">Root Canal and Filling</option>
                            <option value="Crowns and Bridges">Crowns and Bridges</option>
                            <option value="Tooth Extraction">Tooth Extraction</option>
                            <option value="Invisalign">Invisalign</option>
                            <option value="Teeth Whitening">Teeth Whitening</option>
                        </select>
                    </div>
                    <div>
                        <legend class="form-label text-start">Dentist</legend>
                        <select class="form-select" aria-label="Default select example" name="dentist">
                            <option selected>Select Dentist</option>
                            <option value="Dr. Cram Banzal">Dr. Cram Banzal</option>
                            <option value="Dr. Leigh Gegrimos">Dr. Leigh Gegrimos</option>
                            <option value="Dr. Leily Derramas">Dr. Leily Derramas</option>
                            <option value="Dr. Lovely Gallamos">Dr. Lovely Gallamos</option>
                            <option value="Dr. Justin Salvador">Dr. Justin Salvador</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="inputDate" class="form-label">Day</label>
                        <input type="date" name="Day" class="form-control" id="Day" required>
                    </div>
                    <div class="col-md-2">
                        <label for="inputTime" class="form-label">Time</label>
                        <input type="time" name="TIme" class="form-control" id="TIme" required>
                    </div>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Appoint</button>
                </form>
            </div>
        </div>
    </div>
</form>

<div class="container mt-5">
    <h2>Appointment Details</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Fullname</th>
                <th>Services</th>
                <th>Dentist</th>
                <th>Day</th>
                <th>TIme</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo $row['Client_Name']; ?></td>
                    <td><?php echo $row['Services']; ?></td>
                    <td><?php echo $row['Dentist']; ?></td>
                    <td><?php echo $row['Day']; ?></td>
                    <td><?php echo $row['TIme']; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                    <td> 
                        <a href="appointment.php?delete=<?php echo $row['PendingID'];?>" class="delete">DELETE</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

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
