<?php
session_start();
include '../database/dbconfig.php';


if (!isset($_SESSION['user'])) {
    header("Location: ../main/login.php");
}
$message = '';

if (isset($_POST['submit'])) {

    $countername = check_input($_POST['countername']);
    $conn->query("INSERT INTO `counter` VALUES(null, '$countername', 2 )");
    $message = '<div class="alert alert-warning alert-dismissible fade show round-1" role="alert">
    <strong>Success!</strong> ' . $countername . ' is added as counter.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>Counters</title>

</head>

<body class="bg-light">


    <div class="d-flex ">
        <?php include '../partials/_admin_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include '../partials/_admin_nav.php' ?>

            <div class="content p-5">
                <div class="h4 fw-  mb-4"><i class="fa-solid fa-window-restore me-3 "></i>Manage Counters</div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card round-2 shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="h6 fw-bold">Add Counter</div>
                                <hr>
                                <form action="" method="post">
                                    <input type="text" name="countername" class="form-control form-control round-1 mb-3" placeholder="Counter Name" required>
                                    <button type="submit" name="submit" class="float-end btn btn-primary px-3 shadow round-1">Add <i class="fa-solid fa-angles-right ms-2"></i></button>
                                </form>
                                <?= $message ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card round-2 shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="h6 fst-italic">Displaying all counters.</div>
                                <hr>
                                <div class="mt-4">

                                    <?php
                                    $res = $conn->query("SELECT * FROM counter");


                                    if ($res->num_rows > 0) {


                                        while ($row = $res->fetch_assoc()) {

                                            if ($row['status'] == 1) {
                                                $status = "Open";
                                            } else {
                                                $status = "Closed";
                                            }


                                            echo '<div class="card round-1 border-0 shadow-sm bg-light mb-3" id="counter' . $row['counterid'] . '">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="h1 mb-0 fw-"> <i class="fa-solid fa-window-maximize me-3"></i>
                                                    </div>
                                                    <div>
                                                        <div class="h5 mb-0 fw-bold">
                                                            ' . $row['countername'] . '
                                                        </div>
                                                        <div class="smalltxt">Status: ' . $status . '</div>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="h6 text-danger float-end"><i class="fa-solid fa-trash-can pointer" onclick="deleteMe(' . $row['counterid'] . ')"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                    }
                                    ?>



                                </div>

                            </div>
                        </div>
                    </div>

                </div>




            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $("#nav-counter").addClass('mynav-active');


                function deleteMe(id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.post('php/deleteCounter.php', {
                                counterid: id

                            }, function(data) {
                                if (data == 1) {
                                    $("#counter" + id).remove();
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Counter Deleted',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })


                                }
                            });



                        }
                    })
                }
            </script>

</body>

</html>