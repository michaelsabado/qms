<?php

$name = $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['middlename'] . ' ' . $_SESSION['user']['lastname'];

?>

<div class="bg-primary" id="admin-sidebar">
    <div class="myvh p-3 px-4 backdrop">
        <div class="text-center mb-2 py-2 mb-4">
            <img src="../images/psu.png" class="mb-3" height="50" alt="">
            <div class="h6 fw-bold mb-0">School of Advanced Studies</div>
            <div class="text-center " style="font-size: 13px">Pangasinan State University<br>Urdaneta Campus</div>
        </div>
        <hr>
        <div class="d-flex align-items-center mb-3">
            <div class="me-3">
                <img src="../images/admin.jpg" id="profile-pic" height="50" alt="">
            </div>
            <div>
                <div class="h6  fw-bold mb-0"><?= $name ?></div>
                <div class="smalltxt mb-0">System Administrator</div>
            </div>
        </div>
        <hr>


        <a href="index.php" class="text-decoration-none text-white">
            <div class=" round-1  p-3 py-2 profile-card mynav" id="nav-dash">
                <div class="d-flex justify-content-start align-items-center">
                    <div style="width: 40px" class=""><i class="fa-solid fa-boxes-stacked "></i></div>
                    <div class="h6 mb-0 fw-">Dashbooard</div>
                </div>

            </div>
        </a>
        <hr>
        <div class="smalltxt text-muted fw- mt-4 mb-2">Record Management</div>
        <a href="programs.php" class="text-decoration-none text-white">
            <div class=" round-1  p-3 py-2 profile-card mynav " id="nav-programs">
                <div class="d-flex justify-content-start align-items-center">
                    <div style="width: 40px" class=""><i class="fas fa-graduation-cap"></i></div>
                    <div class="h6 mb-0 fw-">Programs</div>
                </div>

            </div>
        </a>
        <a href="counters.php" class="text-decoration-none text-white">
            <div class=" round-1  p-3 py-2 profile-card mynav " id="nav-counter">
                <div class="d-flex justify-content-start align-items-center">
                    <div style="width: 40px" class=""><i class="fa-solid fa-window-restore"></i></div>
                    <div class="h6 mb-0 fw-">Windows</div>
                </div>

            </div>
        </a>
        <a href="services.php" class="text-decoration-none text-white">
            <div class=" round-1  p-3 py-2  profile-card mynav" id="nav-service">
                <div class="d-flex justify-content-start align-items-center">
                    <div style="width: 40px" class=""><i class="fa-solid fa-hand-holding-heart"></i></div>
                    <div class="h6 mb-0 fw-">Services</div>
                </div>

            </div>
        </a>
        <a href="users.php" class="text-decoration-none text-white">
            <div class=" round-1 p-3 py-2 profile-card mynav " id="nav-user">
                <div class="d-flex justify-content-start align-items-center">
                    <div style="width: 40px" class=""><i class="fa-solid fa-users"></i></div>
                    <div class="h6 mb-0 fw-">Users</div>
                </div>

            </div>
        </a>
        <a href="uploads.php" class="text-decoration-none text-white">
            <div class=" round-1 p-3 py-2 profile-card mynav" id="nav-uploads">
                <div class="d-flex justify-content-start align-items-center">
                    <div style="width: 40px" class=""><i class="fa-solid fa-photo-film"></i></div>
                    <div class="h6 mb-0 fw-">Uploads</div>
                </div>

            </div>
        </a>
        <hr>
        <div class="smalltxt text-muted fw- mt-4 mb-2">Account</div>
        <a href="credentials.php" class="text-decoration-none text-white">
            <div class=" round-1  p-3 py-2 mb-2 profile-card mynav " id="nav-credentials">
                <div class="d-flex justify-content-start align-items-center">
                    <div style="width: 40px" class=""><i class="fa-solid fa-user-gear"></i></div>
                    <div class="h6 mb-0 fw-">Account</div>
                </div>

            </div>
        </a>
    </div>
</div>