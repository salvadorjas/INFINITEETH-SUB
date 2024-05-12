<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Clinic Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #fff;
            color: #495057;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #007bff;
        }
        
        .navbar-brand img {
            width: 100px;
            margin-right: 5px;
        }

        .navbar-brand {
            font-size: 20px;
            color: white !important;
        }

        .navbar-nav .nav-link {
            color: white !important;
        }

        .navbar-toggler {
            color: white !important;
        }

        .container {
            padding: 20px;
        }

        .clinic-info {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
    
            margin-top: 100px;
        }

        .clinic-info h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .clinic-info p {
            font-size: 18px;
        }

        .clinic-img {
            margin-top: 50px;
        }

        .clinic-img img {
            max-width: 100%;
        }

        .footer {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .footer img {
            width: 30px;
            height: 30px;
            margin: 0 10px;
        }

        .btn-lg {
            padding: 20px 30px;
            font-size: 20px;
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
        <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Infiniteeth</h1>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="margin-top: 30px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="clinic-info text-center">
                <h2>Welcome to Infiniteeth Dental Clinic</h2>
                <p>Where beautiful smiles begin! We offer comprehensive dental care with a focus on patient comfort and satisfaction. Our experienced team is dedicated to providing you with personalized, high-quality dental services to help you achieve and maintain optimal oral health.</p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center clinic-img">
        <div class="col-md-6">
            <img src="homepic.jpg" alt="Dental Clinic">
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8 text-center">
            <p><a href="login.php" class="btn btn-primary btn-lg me-3">Login</a><a href="registration.php" class="btn btn-secondary btn-lg">Registration</a></p>
        </div>
    </div>
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5>Connect with us:</h5>
                <a href="#"><img src="facebook-logo.png" alt="Facebook"></a>
                <a href="#"><img src="instagram-logo.png" alt="Instagram"></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>Contact us: example@example.com</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
