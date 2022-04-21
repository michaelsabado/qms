<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>Services</title>

</head>

<body class="bg-light">


    <div class="d-flex ">
        <?php include '../partials/_admin_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include '../partials/_admin_nav.php' ?>

            <div class="content p-5">
                <div class="d-flex mb-4 justify-content-between align-items-center">
                    <div class="h4 fw- "><i class="fa-solid fa-users me-3"></i>Manage Users</div>
                    <div><button class="btn btn-primary round-1 shadow-sm">Add User <i class="fa-solid fa-circle-plus ms-2"></i></button></div>
                </div>


                <div class="card round-2 border-0">
                    <div class="card-body p-4">
                        <table id="example" class="table table-striped" style="width:100%">
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

                                <tr>
                                    <td>1</td>
                                    <td>Jessica Trinidad</td>
                                    <td>jessica_04</td>
                                    <td>Staff</td>
                                    <td>Cashier</td>
                                    <td><i class="fa-solid fa-pen-to-square me-3 text-primary"></i><i class="fa-solid fa-trash-can text-danger"></i></td>

                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Danny Ramon</td>
                                    <td>danny_22</td>
                                    <td>Staff</td>
                                    <td>Registrar</td>
                                    <td><i class="fa-solid fa-pen-to-square me-3 text-primary"></i><i class="fa-solid fa-trash-can text-danger"></i></td>


                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Katrina Sindaya</td>
                                    <td>katrina_11</td>
                                    <td>Staff</td>
                                    <td>Registrar</td>
                                    <td><i class="fa-solid fa-pen-to-square me-3 text-primary"></i><i class="fa-solid fa-trash-can text-danger"></i></td>


                                </tr>

                            </tbody>

                        </table>
                    </div>
                </div>




            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $(document).ready(function() {
                    $('#example').DataTable();
                });
                $("#nav-user").addClass('mynav-active');
            </script>

</body>

</html>