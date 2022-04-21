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
                                <form action="">
                                    <input type="text" class="form-control form-control round-1 mb-3" placeholder="Counter Name">
                                    <button class="float-end btn btn-primary px-3 shadow round-1">Add <i class="fa-solid fa-angles-right ms-2"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card round-2 shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="h6 fst-italic">Displaying all counters.</div>
                                <hr>
                                <div class="mt-4">
                                    <div class="card round-1 border-0 shadow-sm bg-light mb-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="h1 mb-0 fw-"> <i class="fa-solid fa-window-maximize me-3"></i>
                                                </div>
                                                <div>
                                                    <div class="h5 mb-0 fw-bold">
                                                        Cashier
                                                    </div>
                                                    <div class="smalltxt">Status: Open</div>
                                                </div>
                                                <div class="ms-auto">
                                                    <div class="h6 text-danger float-end"><i class="fa-solid fa-trash-can"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card round-1 border-0 shadow-sm bg-light mb-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="h1 mb-0 fw-"> <i class="fa-solid fa-window-maximize me-3"></i>
                                                </div>
                                                <div>
                                                    <div class="h5 mb-0 fw-bold">
                                                        Registrar
                                                    </div>
                                                    <div class="smalltxt">Status: Open</div>
                                                </div>
                                                <div class="ms-auto">
                                                    <div class="h6 text-danger float-end"><i class="fa-solid fa-trash-can"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>




            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $("#nav-counter").addClass('mynav-active');
            </script>

</body>

</html>