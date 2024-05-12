<?php
session_start();

include('../connection/connection.php');

if (!isset($_SESSION['UserLogin'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['UserLogin'];
$con = connection();

$profile_query = "SELECT * FROM patient WHERE `Email`='$email'";
$profile_result = $con->query($profile_query);

if ($profile_result->num_rows > 0) {
    $row = $profile_result->fetch_assoc();
    $fullName = $row['Full Name'];
    $sex = $row['Sex'];
    $age = $row['Age'];
    $address = $row['Address'];
    $contact = $row['Contact'];
} else {
}

$con->close();

if(isset($_POST['submitFullName'])) {
    $newFullName = $_POST['newFullName'];

    $con = connection();

    $update_query = "UPDATE patient SET `Full Name`='$newFullName' WHERE `Email`='$email'";

    if ($con->query($update_query) === TRUE) {
        $fullName = $newFullName;

        echo "<script>alert('Full Name updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating Full Name: " . $con->error . "');</script>";
    }

    $con->close();
}

if(isset($_POST['submitEmail'])) {
    $newEmail = $_POST['newEmail'];

    $con = connection();

    $update_query = "UPDATE patient SET `Email`='$newEmail' WHERE `Email`='$email'";

    if ($con->query($update_query) === TRUE) {
        $email = $newEmail;

        echo "<script>alert('Email updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating Email: " . $con->error . "');</script>";
    }

    $con->close();
}

if(isset($_POST['submitSex'])) {
    $newSex = $_POST['newSex'];

    $con = connection();

    $update_query = "UPDATE patient SET `Sex`='$newSex' WHERE `Email`='$email'";

    if ($con->query($update_query) === TRUE) {
        $sex = $newSex;

        echo "<script>alert('Sex updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating Sex: " . $con->error . "');</script>";
    }

    $con->close();
}

if(isset($_POST['submitAge'])) {
    $newAge = $_POST['newAge'];

    $con = connection();

    $update_query = "UPDATE patient SET `Age`='$newAge' WHERE `Email`='$email'";

    if ($con->query($update_query) === TRUE) {
        $age = $newAge;

        echo "<script>alert('Age updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating Age: " . $con->error . "');</script>";
    }

    $con->close();
}

if(isset($_POST['submitAddress'])) {
    $newAddress = $_POST['newAddress'];

    $con = connection();

    $update_query = "UPDATE patient SET `Address`='$newAddress' WHERE `Email`='$email'";

    if ($con->query($update_query) === TRUE) {
        $address = $newAddress;

        echo "<script>alert('Address updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating Address: " . $con->error . "');</script>";
    }

    $con->close();
}

if(isset($_POST['submitContact'])) {
    $newContact = $_POST['newContact'];

    $con = connection();

    $update_query = "UPDATE patient SET `Contact`='$newContact' WHERE `Email`='$email'";

    if ($con->query($update_query) === TRUE) {
        $contact = $newContact;

        echo "<script>alert('Contact updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating Contact: " . $con->error . "');</script>";
    }

    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url('infiBG.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: repeat;
        }
        .container {
            margin-top: 100px;
            max-width: 800px;
            padding: 20px;
            border-radius: 10px;
            background-color: beige;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        th {
            text-align: left;
        }
        .edit-button {
            display: block;
            width: 100%;
            max-width: 150px;
            margin: 0 auto;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">User Profile</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <h1>User Profile</h1>
    <table>
        <tr>
            <th>Full Name</th>
            <td><?php echo isset($fullName) ? $fullName : ''; ?></td>
            <td><button type="button" class="btn btn-primary edit-button" data-bs-toggle="modal" data-bs-target="#editFullNameModal">Edit</button></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo isset($email) ? $email : ''; ?></td>
            <td><button type="button" class="btn btn-primary edit-button" data-bs-toggle="modal" data-bs-target="#editEmailModal">Edit</button></td>
        </tr>
        <tr>
            <th>Sex</th>
            <td><?php echo isset($sex) ? $sex : ''; ?></td>
            <td><button type="button" class="btn btn-primary edit-button" data-bs-toggle="modal" data-bs-target="#editSexModal">Edit</button></td>
        </tr>
        <tr>
            <th>Age</th>
            <td><?php echo isset($age) ? $age : ''; ?></td>
            <td><button type="button" class="btn btn-primary edit-button" data-bs-toggle="modal" data-bs-target="#editAgeModal">Edit</button></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo isset($address) ? $address : ''; ?></td>
            <td><button type="button" class="btn btn-primary edit-button" data-bs-toggle="modal" data-bs-target="#editAddressModal">Edit</button></td>
        </tr>
        <tr>
            <th>Contact</th>
            <td><?php echo isset($contact) ? $contact : ''; ?></td>
            <td><button type="button" class="btn btn-primary edit-button" data-bs-toggle="modal" data-bs-target="#editContactModal">Edit</button></td>
        </tr>
    </table>
</div>

<div class="modal fade" id="editFullNameModal" tabindex="-1" aria-labelledby="editFullNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFullNameModalLabel">Edit Full Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="newFullName" class="form-label">New Full Name</label>
                        <input type="text" class="form-control" id="newFullName" name="newFullName" value="<?php echo isset($fullName) ? $fullName : ''; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submitFullName">Save Changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmailModalLabel">Edit Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="newEmail" class="form-label">New Email</label>
                        <input type="email" class="form-control" id="newEmail" name="newEmail" value="<?php echo isset($email) ? $email : ''; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submitEmail">Save Changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editSexModal" tabindex="-1" aria-labelledby="editSexModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSexModalLabel">Edit Sex</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="newSex" class="form-label">New Sex</label>
                        <input type="text" class="form-control" id="newSex" name="newSex" value="<?php echo isset($sex) ? $sex : ''; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submitSex">Save Changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editAgeModal" tabindex="-1" aria-labelledby="editAgeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAgeModalLabel">Edit Age</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="newAge" class="form-label">New Age</label>
                        <input type="number" class="form-control" id="newAge" name="newAge" value="<?php echo isset($age) ? $age : ''; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submitAge">Save Changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddressModalLabel">Edit Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="newAddress" class="form-label">New Address</label>
                        <input type="text" class="form-control" id="newAddress" name="newAddress" value="<?php echo isset($address) ? $address : ''; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submitAddress">Save Changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContactModalLabel">Edit Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="newContact" class="form-label">New Contact</label>
                        <input type="text" class="form-control" id="newContact" name="newContact" value="<?php echo isset($contact) ? $contact : ''; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submitContact">Save Changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

