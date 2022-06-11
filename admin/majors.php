<?php
session_start();
include '../database/dbconfig.php';


if (!isset($_SESSION['user']) || $_SESSION['user']['usertype'] != 1) {
    header("Location: ../main/login.php");
}


if (isset($_GET['id'])) {
    $sql = "SELECT * FROM program WHERE programid = " . check_input($_GET['id']);

    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $programdata = $res->fetch_assoc();
    } else {
        header("Location: programs.php");
    }
} else {
}



$message = '';

if (isset($_POST['submit'])) {

    $description = check_input($_POST['description']);
    $progid = check_input($_GET['id']);

    $conn->query("INSERT INTO `major` VALUES(null, '$progid','$description' )");
    $message = '<div class="alert alert-warning alert-dismissible fade show round-1" role="alert">
    <strong>Success!</strong> ' . $description . ' is added as major.
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
    <title>QMS | Programs</title>

</head>

<body class="bg-light">


    <div class="d-flex ">
        <?php include '../partials/_admin_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include '../partials/_admin_nav.php' ?>

            <div class="content p-5">
                <div class="d-flex mb-4 justify-content-between align-items-center">
                    <div class="h4 fw- "><i class="fa-solid fa-hand-holding-heart me-3"></i><a href="programs.php" class="text-decoration-none">Manage Programs</a> > <?= $programdata['programdescription'] ?></div>
                    <div><button class="btn btn-primary round-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Add major <i class="fa-solid fa-circle-plus ms-2"></i></button></div>
                </div>


                <div class="card round-2 border-0 shadow-sm">
                    <div class="card-body p-4 pb-0">

                        <div class="table-responsive" style="height: calc(100vh - 255px); overflow-y: auto">
                            <?= $message ?>
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Major</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $res = $conn->query("SELECT * FROM major WHERE programid = " . check_input($_GET['id']));

                                    if ($res->num_rows > 0) {
                                        $count = 0;
                                        while ($row = $res->fetch_assoc()) {


                                            echo '  <tr id="major' . $row['majorid'] . '">
                                            <td>' . ++$count . '</td>
                                            <td>' . $row['majordescription'] . '</td>
                                        <td><i class="fa-solid fa-pen-to-square me-3 text-primary"></i><i class="fa-solid fa-trash-can text-danger pointer " onclick="deleteMe(' . $row['majorid'] . ')"></i>
                                      
                                        </td>

                                    </tr>';
                                        }
                                    } else {
                                        echo '  <tr>
                                    <td colspan="3">Nothing to show</td>

                                </tr>';
                                    }

                                    ?>



                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>




            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content round-1 border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add major</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="addForm">


                                <div class="h6">Description</div>
                                <input type="text" class="form-control round-1 mb-3" name="description" placeholder="" required>
                            </form>

                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" form="addForm" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $(document).ready(function() {
                    $('#example').DataTable();
                });

                $("#nav-programs").addClass('mynav-active');

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

                            $.post('php/deletemajor.php', {
                                majorid: id

                            }, function(data) {
                                if (data == 1) {
                                    $("#major" + id).remove();
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Major Deleted',
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