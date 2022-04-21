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







            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $("#nav-dash").addClass('mynav-active');
            </script>
</body>

</html>