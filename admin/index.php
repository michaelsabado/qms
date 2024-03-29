<?php
session_start();
include '../database/dbconfig.php';



if (!isset($_SESSION['user']) || $_SESSION['user']['usertype'] != 1) {
    header("Location: ../main/login.php");
}



$a = $conn->query("SELECT * FROM counter")->num_rows;
$b = $conn->query("SELECT * FROM service")->num_rows;
$c = $conn->query("SELECT * FROM user WHERE usertype != 1")->num_rows;
$d = $conn->query("SELECT * FROM program")->num_rows;
$e = $conn->query("SELECT * FROM major WHERE majordescription != 'n/a'")->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>QMS | Admin Dashboard</title>

</head>

<body class="bg-light">


    <div class="d-flex ">
        <?php include '../partials/_admin_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include '../partials/_admin_nav.php' ?>

            <div class="content p-5 pb-0">
                <div class="h4 fw-  mb-4"><i class="fa-solid fa-boxes-stacked me-3"></i>Dashboard</div>
                <div class="" style="height: calc(100vh - 180px); overflow-y: auto; overflow-x: hidden;">


                    <div class="row">
                        <div class="col-md-3">
                            <div class="card round-2  shadow-sm  mb-3 box">
                                <div class="card-body p-4">
                                    <div class="display-5 float-end"><i class="fa-solid fa-window-restore"></i></div>
                                    <div class="h6 fw-bold">Windows</div>
                                    <div class="display-5"><?= $a ?></div>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card round-2  shadow-sm  mb-3 box">
                                <div class="card-body p-4">
                                    <div class="display-5 float-end"><i class="fa-solid fa-hand-holding-heart"></i></div>
                                    <div class="h6 fw-bold">Services</div>
                                    <div class="display-5"><?= $b ?></div>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card round-2  shadow-sm  mb-3 box">
                                <div class="card-body p-4">
                                    <div class="display-5 float-end"><i class="fa-solid fa-users"></i></div>

                                    <div class="h6 fw-bold">Users/Operators</div>
                                    <div class="display-5"><?= $c ?></div>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card round-2  shadow-sm  mb-3 box">
                                <div class="card-body p-4">
                                    <div class="display-5 float-end"><i class="fas fa-graduation-cap"></i>

                                    </div>

                                    <div class="h6 fw-bold">Programs</div>
                                    <div class="smalltxt float-end me-4"><?= $e ?> Majors</div>
                                    <div class="display-5"><?= $d ?></div>



                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card round-2 border-0 shadow-sm  mb-3">
                                <div class="card-body p-4">

                                    <div class="h6 fw-bold">Fetch Record</div>
                                    <form action="" id="fetchform">


                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="smalltxt">Select Counter</div>

                                                <select name="counter" id="sel-window" class="form-select round-1" required>
                                                    <option value="All">All</option>
                                                    <?php

                                                    $res = $conn->query("SELECT * FROM counter");

                                                    if ($res->num_rows > 0) {
                                                        while ($row = $res->fetch_assoc()) {
                                                            echo '<option  value="' . $row['counterid'] . '">Window ' . $row['windowno'] . '</option>';
                                                        }
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="smalltxt">Select date</div>
                                                <input type="date" value="<?= date("Y-m-d") ?>" name="date" id="sel-date" class="form-control round-1 mb-3" required>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="smalltxt text-white">.</div>
                                                <button type="submit" class="btn btn-primary round-1 shadow-sm me-2">Fetch <i class="fa-solid fa-download ms-2"></i></button>
                                                <button type="button" class="btn btn-success round-1 shadow-sm" onclick="printMe()">Create PDF <i class="fas fa-print ms-2"></i></button>

                                            </div>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card round-2 border-0 shadow-sm  mb-3">
                                <div class="card-body p-4" id="queue-table">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>





            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $("#nav-dash").addClass('mynav-active');

                function printMe() {
                    window.location.href = "print.php?counter=" + $("#sel-window").val() + "&date=" + $("#sel-date").val();
                }

                $("#queue-table").load('ajax/fetch-queue.php', $("#fetchform").serialize());

                $("#fetchform").submit(function(e) {
                    e.preventDefault();


                    $("#queue-table").load('ajax/fetch-queue.php', $("#fetchform").serialize());



                });
            </script>
</body>

</html>