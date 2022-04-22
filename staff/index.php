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
                <div class="h4 fw-  mb-4"><i class="fa-solid fa-boxes-stacked me-3"></i>Dashboard</div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card round-2 shadow-sm  mb-3" style="   border: 3px solid rgb(13, 110, 253);">
                            <div class="card-body p-4">
                                <div class="h5 fw-bold text-primary">Now Serving</div>
                                <div class="text- fw- mb-0" style="font-size: 90px;">1002</div>
                                <div class="h6"><b>Client</b>: 18-UR-0698</div>
                                <div class="h6"><b>Service</b>: Application for Graduation</div>
                            </div>
                        </div>
                        <div class="card round-2 shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="h6 fw-bold text-primary mb-4">Controls</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card border-0  p-2 align-items-center shadow text-center bg-primary mb-3 round-1">
                                            <div class="h5 text-white mb-0">Transfer <i class="fas fa-exchange-alt"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 p-2 align-items-center shadow text-center bg-success mb-3 round-1">
                                            <div class="h5 text-white mb-0">Call Next <i class="fas fa-angle-double-right"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 p-2 align-items-center shadow text-center bg-warning mb-3 round-1">
                                            <div class="h5 text-white mb-0">Recall <i class="fas fa-redo"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 p-2 align-items-center shadow text-center bg-danger mb-3 round-1">
                                            <div class="h5 text-white mb-0">Void <i class="fas fa-ban"></i></div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card round-2 shadow-sm border-0 mb-3">
                            <div class="card-body p-3">
                                <div class="card bg-light border-0 mb-3 shadow-sm round-1">
                                    <div class="card-body">
                                        <div class="h6 fw-">Total Served</div>
                                        <div class="h2 text- fw-bold text-end mb-0 text-dark">26</div>
                                    </div>
                                </div>
                                <div class="card bg-light border-0 mb-3 shadow-sm round-1">
                                    <div class="card-body">
                                        <div class="h6 fw- text-">Pending Clients</div>
                                        <div class="h2 text- fw-bold text-end mb-0 text-dark">3</div>

                                    </div>
                                </div>
                                <div class="card border-0 shadow-sm round-1">
                                    <div class="card-body">
                                        <div class="h6 fw-bold text-center text-success mb-3"><i class="fas fa-angle-double-down me-2"></i>Next Clients <i class="fas fa-angle-double-down ms-1"></i></div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item  text-center ">
                                                <div class="d-flex justify-content-between">
                                                    <div></div>
                                                    <div class="h6 fw-bold">1004</div>
                                                    <div><i class="far fa-caret-square-down"></i></div>
                                                </div>
                                            </li>
                                            <li class="list-group-item  text-center ">
                                                <div class="d-flex justify-content-between">
                                                    <div></div>
                                                    <div class="h6 fw-bold">1007</div>
                                                    <div><i class="far fa-caret-square-down"></i></div>
                                                </div>
                                            </li>
                                            <li class="list-group-item  text-center ">
                                                <div class="d-flex justify-content-between">
                                                    <div></div>
                                                    <div class="h6 fw-bold">1013</div>
                                                    <div><i class="far fa-caret-square-down"></i></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>





            </div>



            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $("#nav-dash").addClass('mynav-active');
            </script>
</body>

</html>