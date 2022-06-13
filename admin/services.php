<?php
session_start();
include '../database/dbconfig.php';


if (!isset($_SESSION['user']) || $_SESSION['user']['usertype'] != 1) {
    header("Location: ../main/login.php");
}

$message = '';

if (isset($_POST['submit'])) {

    $description = check_input($_POST['description']);
    $category = $_POST['category'];

    $conn->query("INSERT INTO `service` VALUES(null, '$category','$description' )");
    $message = '<div class="alert alert-warning alert-dismissible fade show round-1" role="alert">
    <strong>Success!</strong> ' . $description . ' is added as service.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if (isset($_POST['submit1'])) {
    $id = $_POST['id'];
    $description = check_input($_POST['description']);
    $category = $_POST['category'];

    $conn->query("UPDATE service SET category = $category, description = '$description' WHERE serviceid = $id");
    $message = '<div class="alert alert-warning alert-dismissible fade show round-1" role="alert">
    <strong>Success!</strong> ' . $description . ' is now set.
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
    <title>QMS | Services</title>

</head>

<body class="bg-light">


    <div class="d-flex ">
        <?php include '../partials/_admin_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include '../partials/_admin_nav.php' ?>

            <div class="content p-5">
                <div class="d-flex mb-4 justify-content-between align-items-center">
                    <div class="h4 fw- "><i class="fa-solid fa-hand-holding-heart me-3"></i>Manage Services</div>
                    <div><button class="btn btn-primary round-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Service <i class="fa-solid fa-circle-plus ms-2"></i></button></div>
                </div>


                <div class="card round-2 border-0 shadow-sm">
                    <div class="card-body p-4 pb-0">

                        <div class="table-responsive" style="height: calc(100vh - 255px); overflow-y: auto">
                            <?= $message ?>
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Service</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $res = $conn->query("SELECT * FROM service ORDER BY category");

                                    if ($res->num_rows > 0) {
                                        $count = 0;
                                        while ($row = $res->fetch_assoc()) {

                                            $type = '';

                                            switch ($row['category']) {
                                                case 1:
                                                    $type = 'Request';
                                                    break;
                                                case 2:
                                                    $type = 'Enrollment';
                                                    break;
                                                case 3:
                                                    $type = 'Application';
                                                    break;
                                                case 4:
                                                    $type = 'Claiming';
                                                    break;
                                                case 5:
                                                    $type = 'Submission';
                                                    break;
                                                case 6:
                                                    $type = 'Query & Others';
                                                    break;
                                            }


                                            echo '  <tr id="service' . $row['serviceid'] . '">
                                            <td>' . ++$count . '</td>
                                            <td>' . $type . '</td>
                                            <td>' . $row['description'] . '</td>
                                        <td><i class="fa-solid fa-pen-to-square me-3 text-primary pointer" data-bs-toggle="modal" data-bs-target="#exampleModal1" onclick="initEdit(' . $row['serviceid'] . ',' . $row['category'] . ',\'' . $row['description'] . '\')"></i><i class="fa-solid fa-trash-can text-danger pointer " onclick="deleteMe(' . $row['serviceid'] . ')"></i></td>
    
                                    </tr>';
                                        }
                                    } else {
                                        echo '  <tr id="service' . $row['serviceid'] . '">
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="addForm">

                                <div class="h6">Type</div>
                                <select name="category" class="form-select mb-3 round-1" required onchange="fetchServices($(this).val())">

                                    <option value="1">Requests</option>
                                    <option value="2">Enrollment</option>
                                    <option value="3">Application</option>
                                    <option value="4">Claiming</option>
                                    <option value="5">Submission</option>
                                    <option value="6">Query & Others</option>
                                </select>
                                <div class="h6">Service</div>
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
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content round-1 border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="editForm">
                                <input type="hidden" name="id" id="id">
                                <div class="h6">Type</div>
                                <select name="category" id="category_u" class="form-select mb-3 round-1" required>

                                    <option value="1">Requests</option>
                                    <option value="2">Enrollment</option>
                                    <option value="3">Application</option>
                                    <option value="4">Claiming</option>
                                    <option value="5">Submission</option>
                                    <option value="6">Query & Others</option>
                                </select>
                                <div class="h6">Service</div>
                                <input type="text" class="form-control round-1 mb-3" name="description" id="description_u" placeholder="" required>
                            </form>

                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit1" form="editForm" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $(document).ready(function() {
                    $('#example').DataTable();
                });

                $("#nav-service").addClass('mynav-active');



                function initEdit(id, cat, desc) {
                    $("#description_u").val(desc);
                    $("#category_u").val(cat);
                    $("#id").val(id);

                    // alert($("#editForm").serialize());
                }

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

                            $.post('php/deleteService.php', {
                                serviceid: id

                            }, function(data) {
                                if (data == 1) {
                                    $("#service" + id).remove();
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Service Deleted',
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