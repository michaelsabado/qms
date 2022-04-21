<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>PSU SAS | Login</title>
    <style>
        body {
            background-image: linear-gradient(to top, rgba(0, 0, 250, 0.7), rgba(250, 250, 250, 0.8)), url("../images/bg.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;

        }
    </style>
</head>

<body>


    <div class="">
        <div class="text-center" style="position: relative; z-index: 100;"><img src=" ../images/psu.png" class="mb-3 mt-5" height="130" alt=""></div>
        <div class=" card mt-5 border-0 round-2 mx-auto" style="max-width: 450px;background: rgba(250,250,250,0.7); backdrop-filter: blur(3px); position: relative; top:-125px; z-index:0;">
            <div class="card-body bg-transparent p-4 px-5">


                <div class="h5 fw- text-center mb-0 mt-5">School of Advanced Studies</div>
                <div class="text-center mb-5" style="font-size: 13px">Pangasinan State University | Urdaneta Campus</div>
                <div class="alert alert-light round-1 shadow-sm border-0 smalltxt" role="alert">
                    Welcome to <b>Queue Management System</b>, please login.
                </div>
                <form action="" class="mt-4">
                    <div class="h6 fw-">Username</div>
                    <input type="text" class="form-control round-1 mb-3">
                    <div class="h6 fw-">Password</div>
                    <input type="text" class="form-control round-1 mb-3">
                    <a href="../staff" class="btn btn-primary round-1 shadow w-100 mt-3 mb-3">Login <i class="fas fa-angle-double-right"></i></a>
                    <div class="text-center">Forgot password?</div>
                </form>



            </div>
        </div>
    </div>


    <div class="h6 text-center w-100 text-white" style="position: fixed; bottom:10px;z-index: -2">Copyright &copy; Pangasinan State University</div>

</body>

</html>