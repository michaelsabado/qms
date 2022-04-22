<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>Dashboard</title>

</head>

<body class="bg-light">


    <div class="d-flex ">
        <?php include '../partials/_admin_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include '../partials/_admin_nav.php' ?>

            <div class="content p-5">
                <div class="h4 fw-  mb-4"><i class="fa-solid fa-boxes-stacked me-3"></i>Dashboard</div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card round-2  shadow-sm  mb-3 box">
                            <div class="card-body p-4">
                                <div class="display-5 float-end"><i class="fa-solid fa-window-restore"></i></div>
                                <div class="h6 fw-bold">Counters</div>
                                <div class="display-5">2</div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card round-2  shadow-sm  mb-3 box">
                            <div class="card-body p-4">
                                <div class="display-5 float-end"><i class="fa-solid fa-hand-holding-heart"></i></div>
                                <div class="h6 fw-bold">Services</div>
                                <div class="display-5">7</div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card round-2  shadow-sm  mb-3 box">
                            <div class="card-body p-4">
                                <div class="display-5 float-end"><i class="fa-solid fa-users"></i></div>

                                <div class="h6 fw-bold">Users</div>
                                <div class="display-5">3</div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card round-2 border-0 shadow-sm  mb-3">
                            <div class="card-body p-4">

                                <div class="h6 fw-bold">Generate Report</div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="smalltxt">Select Counter</div>
                                        <select name="" id="" class="form-select round-1">
                                            <option value="">Registrar</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="smalltxt">Select date</div>
                                        <input type="date" class="form-control round-1 mb-3">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="smalltxt">.</div>
                                        <button class="btn btn-primary round-1 shadow-sm">Fetch <i class="fa-solid fa-download ms-2"></i></button>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card round-2 border-0 shadow-sm  mb-3">
                            <div class="card-body p-4">
                                <div class="table-responsive">


                                    <table id="example" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Identification</th>
                                                <th>Service</th>
                                                <th>Token</th>
                                                <th>Status</th>
                                                <th>Timestamp</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>18-UR-0698</td>
                                                <td>Application for Graduation</td>
                                                <td>1003</td>
                                                <td>Served</td>
                                                <td>2022-04-25 12:05:36</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Denise Briones</td>
                                                <td>Certificate of Grades</td>
                                                <td>1007</td>
                                                <td>Served</td>
                                                <td>2022-04-25 12:05:36</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>19-UR-4372</td>
                                                <td>Certificate of Grades</td>
                                                <td>1007</td>
                                                <td>Void</td>
                                                <td>2022-04-25 12:05:36</td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>







            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $(document).ready(function() {
                    $('#example').DataTable();
                });
                $("#nav-dash").addClass('mynav-active');
            </script>
</body>

</html>