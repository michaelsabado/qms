<?php
session_start();
include '../database/dbconfig.php';


if (!isset($_SESSION['user'])) {
    header("Location: ../main/login.php");
}
$message = '';

if (isset($_POST['submit'])) {

    $firstname = check_input($_POST['firstname']);
    $middlename = check_input($_POST['middlename']);
    $lastname = check_input($_POST['lastname']);
    $username = check_input($_POST['username']);
    $counter = check_input($_POST['counter']);


    $conn->query("INSERT INTO `user` VALUES(null, '$firstname','$middlename', '$lastname', '$username', '$username', 2, $counter )");
    $message = '<div class="alert alert-warning alert-dismissible fade show round-1" role="alert">
    <strong>Success!</strong> ' . $firstname . ' is added as user(Staff).
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
    <title>QMS | Users</title>

</head>

<body class="bg-light">


    <div class="d-flex ">
        <?php include '../partials/_admin_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include '../partials/_admin_nav.php' ?>

            <div class="content p-5">
                <div class="d-flex mb-4 justify-content-between align-items-center">
                    <div class="h4 fw- "><i class="fa-solid fa-users me-3"></i>Manage Users</div>
                    <div><button class="btn btn-primary round-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Add User <i class="fa-solid fa-circle-plus ms-2"></i></button></div>
                </div>


                <div class="card round-2 border-0 shadow-sm">
                    <div class="card-body p-4 pb-0">
                        <div class="table-responsive" style="height: calc(100vh - 255px); overflow-y: auto">
                            <?= $message ?>
                            <table id="example" class="table  table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Usertype</th>
                                        <th>Assigned Counter</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $res = $conn->query("SELECT * FROM user a LEFT JOIN counter b ON a.counterid = b.counterid");

                                    if ($res->num_rows > 0) {
                                        $count = 1;
                                        while ($row = $res->fetch_assoc()) {
                                            if ($row['usertype'] == 1) $usertype = 'Admin';
                                            else if ($row['usertype'] == 2) $usertype = 'Staff';
                                            echo ' <tr id="user' . $row['userid'] . '">
                                        <td>' . $count . '</td>
                                        <td>' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . '</td>
                                        <td>' . $row['username'] . '</td>
                                        <td>' . $usertype . '</td>
                                        <td>' . $row['countername'] . '</td>
                                        <td><i class="fa-solid fa-pen-to-square me-3 text-primary"></i><i class="fa-solid fa-trash-can text-danger pointer" onclick="deleteMe(' . $row['userid'] . ')"></i></td>
                                    </tr>';

                                            $count++;
                                        }
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
                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="addForm">
                                <div class="h6">Firstname</div>
                                <input type="text" class="form-control round-1 mb-3" name="firstname" placeholder="Juan" required>
                                <div class="h6">Middlename</div>
                                <input type="text" class="form-control round-1 mb-3" name="middlename" placeholder="Dela">
                                <div class="h6">Lastname</div>
                                <input type="text" class="form-control round-1 mb-3" name="lastname" placeholder="Cruz" required>
                                <div class="h6">Username</div>
                                <input type="text" class="form-control round-1 mb-3" name="username" placeholder="Cruz" required>
                                <div class="h6">Counter Assignment</div>
                                <select name="counter" id="" class="form-select round-1" required>
                                    <?php

                                    $res = $conn->query("SELECT * FROM counter");

                                    if ($res->num_rows > 0) {
                                        while ($row = $res->fetch_assoc()) {
                                            echo '<option value="' . $row['counterid'] . '">' . $row['countername'] . '</option>';
                                        }
                                    }

                                    ?>
                                </select>
                            </form>

                        </div>
                        <div class="modal-footer">
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
                $("#nav-user").addClass('mynav-active');


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

                            $.post('php/deleteUser.php', {
                                userid: id

                            }, function(data) {
                                if (data == 1) {
                                    $("#user" + id).remove();
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'User Deleted',
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