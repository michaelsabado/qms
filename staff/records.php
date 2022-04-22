<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>Counter</title>

</head>

<body class="bg-light">


    <div class="d-flex ">
        <?php include '../partials/_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include '../partials/_nav.php' ?>

            <div class="content p-5">
                <div class="h4 fw-  mb-4"><i class="fa-solid fa-book me-3"></i>Records</div>

                <div class="card round-2 border-0 shadow-sm  mb-3">
                    <div class="card-body p-4">
                        <div style="max-width: 300px">
                            <div class="h6 fw-bold">Generate Report</div>
                            <div class="smalltxt">Select date</div>
                            <input type="date" class="form-control round-1 mb-3">
                            <button class="btn btn-primary round-1 shadow-sm">Fetch <i class="fa-solid fa-download ms-2"></i></button>
                        </div>

                    </div>
                </div>

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



        <?php include '../partials/_admin_footer.php' ?>

        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
            $(" #nav-records").addClass('mynav-active');
        </script>
</body>

</html>