<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function connection() {
    $host = "localhost";
    $username = "root";
    $password = "new_password";
    $dbname = "infiniteeth";
    
    $conn = new mysqli($host, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

function register() {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $fullname = $_POST['fullname'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    
    if(empty($email) || empty($password) || empty($fullname) || empty($sex) || empty($age) || empty($address) || empty($contact)) {
        echo "<script>alert('Please fill up all fields.');</script>";
    } else {
        $conn = connection();
        
        $stmt = $conn->prepare("INSERT INTO patient (email, Password, `Full Name`, sex, age, address, contact) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiss", $email, $password, $fullname, $sex, $age, $address, $contact);
        
        if ($stmt->execute()) {
            echo "<script>alert('You are successfully registered');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
        $conn->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    register();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #fff;
            color: #495057;
        }

        .container {
            padding: 20px;
        }

        form {
            margin-top: 100px;
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-label {
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 15px 30px;
            font-size: 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            padding: 15px 30px;
            font-size: 20px;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .navbar-brand img {
            width: 80px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logooo-removebg-preview.png" alt="Logo" class="d-inline-block align-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
                <div class="offcanvas-header">
                    <h1 class="offcanvas-title">Infiniteeth</h1>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="margin-top: 30px;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                        </li>
                      
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<div class='alert alert-danger' role='alert'>You are successfully registered</div>";
        }
        ?>
        <form action="registration.php" method="post">
            <h2>Registration</h2>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputFullName" class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control" id="exampleInputFullName">
            </div>
            <div class="mb-3">
                <label for="exampleInputSex" class="form-label">Sex</label>
                <select class="form-select" name="sex" id="exampleInputSex">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputAge" class="form-label">Age</label>
                <input type="number" name="age" class="form-control" id="exampleInputAge">
            </div>
            <div class="mb-3">
                <label for="exampleInputAddress" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="exampleInputAddress">
            </div>
            <div class="mb-3">
                <label for="exampleInputContact" class="form-label">Contact</label>
                <input type="text" name="contact" class="form-control" id="exampleInputContact">
            </div>
            <button type="submit" name="btnRegister" class="btn btn-primary">Register</button>
            <a href="login.php" class="btn btn-danger">Login</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>

