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
                <div class="h4 fw-  mb-4"><i class="fa-solid fa-photo-film me-3"></i>Manage Uploads</div>


                <div class="card round-2 border-0 shadow-sm mb-3">
                    <div class="card-body p-4">
                        <div class="smalltxt mb-2 text-muted fst-italic">Media uploaded will be displayed as announcement/advertisement to clients.</div>
                        <form action="" id="manage-uploads">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <input type="file" class="d-none" id="chooseFile" multiple="multiple" onchange="displayIMG(this)" accept="image/x-png,image/gif,image/jpeg,video/mp4">
                                <div id="drop" class="text-center border p-4 round-1 bg-light">
                                    <span id="dname" class="text-center">Drop Files Here <br> or <br> <label for="chooseFile"><strong>Choose File</strong></label></span>
                                </div>
                            </div>

                            <!-- <div class="imgF" style="display: none " id="img-clone">
                                <span class="rem badge badge-primary" onclick="rem_func($(this))"><i class="fa fa-times"></i></span>
                            </div> -->

                            <div class="mt-4">

                                <button class="btn  btn-primary col-sm-3 offset-md-3 round-1"> Upload</button>
                                <button class="btn  btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button>


                            </div>
                        </form>
                    </div>
                </div>

                <div class="card round-2 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="../uploads/anc1.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="col-md-2">
                                <img src="../uploads/anc2.png" class="img-fluid" alt="">
                            </div>
                            <div class="col-md-2">
                                <img src="../uploads/anc3.png" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>



            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $("#nav-uploads").addClass('mynav-active');
            </script>

</body>

</html>