<?php
session_start();
include '../database/dbconfig.php';


if (!isset($_SESSION['user'])) {
    header("Location: ../main/login.php");
}




$userid = $_SESSION['user']['userid'];
$message1 = "";
$message2 = "";

if (isset($_POST['personal-form'])) {


    $firstname = check_input($_POST['firstname']);
    $middlename = check_input($_POST['middlename']);
    $lastname = check_input($_POST['lastname']);



    $sql = "UPDATE user SET firstname = '$firstname', middlename='$middlename', lastname= '$lastname' WHERE userid = $userid";
    $conn->query($sql);
    $message1 = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Personal information updated.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    $_SESSION['user']['firstname'] = $firstname;
    $_SESSION['user']['middlename'] = $middlename;
    $_SESSION['user']['lastname'] = $lastname;
}

if (isset($_POST['account-form'])) {


    $username = check_input($_POST['username']);
    $oldpass = check_input($_POST['oldpass']);
    $newpass = check_input($_POST['newpass']);

    $currentpass = $_SESSION['user']['password'];

    if ($currentpass == $oldpass) {
        $sql = "UPDATE user SET username = '$username', `password`='$newpass' WHERE userid = $userid";
        $conn->query($sql);
        $message2 = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Success.</strong> Credentials updated.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['password'] = $newpass;
    } else {
        $message2 = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oops. </strong> Incorrect old password.
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

$sql = "SELECT * FROM user WHERE userid = " . $_SESSION['user']['userid'];
$user = $conn->query($sql)->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>QMS | Uploads</title>
    <style>
        h3 {
            line-height: 30px;
            text-align: center;
        }

        #drop_file_area {
            height: 200px;
            border: 2px dashed #ccc;
            line-height: 200px;
            text-align: center;
            font-size: 20px;
            background: #f9f9f9;
            margin-bottom: 15px;
        }

        /* .drag_over {
            color: #000;
            border-color: #000;
        } */
    </style>
</head>

<body class="bg-light">


    <div class="d-flex ">
        <?php include '../partials/_admin_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include '../partials/_admin_nav.php' ?>

            <div class="content p-5" style="height: calc(100vh - 72px); overflow-y: auto">
                <div class="h4 fw-  mb-4"><i class="fa-solid fa-user-gear me-3"></i>Account</div>


                <div class="card round-2 border-0 shadow-sm mb-3">
                    <div class="card-body p-4">
                        <div class="smalltxt mb-2 text-muted fst-italic">Manage and protect your account.</div>
                        <div class="container mt-3">
                            <div class="h6 fw-bold mb-3">Personal Information</div>
                            <?= $message1 ?>
                            <form action="" method="post">
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-3">
                                        <div class="h6">Firstname</div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="firstname" class="form-control round-1" value="<?= $user['firstname'] ?>" required>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-3">
                                        <div class="h6">Middlename</div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="middlename" class="form-control round-1" value="<?= $user['middlename'] ?>">
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-3">
                                        <div class="h6">Lastname</div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="lastname" class="form-control round-1" value="<?= $user['lastname'] ?>" required>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="text-end mt-4">
                                            <button type="submit" name="personal-form" class="btn btn-primary round-1 ">Save <i class="fas fa-save ms-2"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="h6 fw-bold mb-3">Credentials</div>
                            <?= $message2 ?>
                            <form action="" method="post">
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-3">
                                        <div class="h6">Username</div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="username" class="form-control round-1" value="<?= $user['username'] ?>" required>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-3">
                                        <div class="h6">Old Password</div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="password" name="oldpass" class="form-control round-1 mb-3" required>
                                    </div>
                                    <div class="col-md-5"></div>
                                    <div class="col-md-3">
                                        <div class="h6 mb-0">New Password</div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="password" name="newpass" pattern=".{6,}" class="form-control round-1" required>
                                        <div class="smalltxt text-muted">Must be 6 characters above.</div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="text-end mt-4">
                                            <button type="submit" name="account-form" class="btn btn-primary round-1 ">Save <i class="fas fa-save ms-2"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>





            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $("#nav-credentials").addClass('mynav-active');
            </script>

</body>

</html>