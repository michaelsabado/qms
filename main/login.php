<?php
session_start();
include '../database/dbconfig.php';



if (isset($_SESSION['user'])) {
    redirectMe($_SESSION['user']['usertype']);
}



$message = "";
if (isset($_POST['submit'])) {

    $username = check_input($_POST['username']);
    $password = check_input($_POST['password']);

    $conn->real_escape_string($username);
    $conn->real_escape_string($password);

    $sql = "SELECT * FROM user a LEFT JOIN counter b ON a.counterid = b.counterid WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        if ($user['password'] == $password) {

            $_SESSION['user'] = $user;

            redirectMe($user['usertype']);
        } else {
            $message = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Oops!</strong> Incorrect password.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    } else {
        $message = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> Account not found.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}

function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function redirectMe($val)
{

    if ($val == 1) {
        header("Location: ../admin");
    } else if ($val == 2) {
        header("Location: ../staff");
    }
}



?>






<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>PSU SAS | Login</title>
    <style>
        body {
            background-image: linear-gradient(to top, rgba(0, 0, 250, 0.7), rgba(250, 250, 250, 0.8)), url("../images/bg.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;

        }
    </style>
</head>

<body>


    <div class="">
        <div class="text-center" style="position: relative; z-index: 100;"><img src=" ../images/psu.png" class="mb-3 mt-5" height="130" alt=""></div>
        <div class=" card mt-5 border-0 round-2 mx-auto" style="max-width: 450px;background: rgba(250,250,250,0.7); backdrop-filter: blur(3px); position: relative; top:-125px; z-index:0;">
            <div class="card-body bg-transparent p-4 px-5">


                <div class="h5 fw- text-center mb-0 mt-5">School of Advanced Studies</div>
                <div class="text-center mb-5" style="font-size: 13px">Pangasinan State University | Urdaneta Campus</div>
                <div class="alert alert-light round-1 shadow-sm border-0 smalltxt" role="alert">
                    Welcome to <b>Queue Management System</b>, please login.
                </div>
                <?= $message ?>
                <form action="" method="post" class="mt-4">
                    <div class="h6 fw-">Username</div>
                    <input type="text" name="username" class="form-control round-1 mb-3" required>
                    <div class="h6 fw-">Password</div>
                    <input type="password" name="password" class="form-control round-1 mb-3" required>
                    <button type="submit" name="submit" class="btn btn-primary round-1 shadow w-100 mt-3 mb-3">Login <i class="fas fa-angle-double-right"></i></button>
                    <div class="text-center pointer" onclick="resetPass()">Forgot password?</div>
                </form>



            </div>
        </div>
    </div>


    <div class="h6 text-center w-100 text-white" style="position: fixed; bottom:10px;z-index: -2">Copyright &copy; Pangasinan State University</div>

    <script src="../partials/sweetalert.js"></script>
    <script>
        function resetPass() {
            Swal.fire(
                'Contact Administrator',
                'And request for password reset.',
                'info'
            )
        }
    </script>
</body>

</html>