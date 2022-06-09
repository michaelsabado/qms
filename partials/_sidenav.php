<?php

$name = $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'];
$counter_status = $_SESSION['user']['status'];
$counter_id = $_SESSION['user']['counterid'];
// print_r($_SESSION['user']);
?>
<div class="bg-primary" id="sidebar">
    <div class="myvh p-3 px-4 backdrop">
        <div class="text-center mb-2 py-3 mb-4">
            <img src="../images/psu.png" class="mb-3" height="80" alt="">
            <div class="h6 fw-bold mb-0">School of Advanced Studies</div>
            <div class="text-center " style="font-size: 13px">Pangasinan State University<br>Urdaneta Campus</div>
        </div>
        <hr>
        <div class="d-flex align-items-center mb-3">
            <div class="me-3">
                <img src="../images/profile.jpg" id="profile-pic" height="50" alt="">
            </div>
            <div>
                <div class="h6  fw-bold mb-0"><?= $name ?></div>
                <div class="smalltxt mb-0"><?= $_SESSION['user']['countername'] ?> | Staff</div>
            </div>
        </div>
        <hr>

        <div class="d-flex justify-content-between align-items-center">
            <div class="h6 fw-  smalltxt mb-0">Counter Status</div>
            <div class="form-check form-switch mb-0">

                <input class="form-check-input " type="checkbox" role="switch" id="toggleState" <?= ($counter_status == 1) ? 'checked' : '' ?> onchange="changeStatus(<?= $counter_id ?>)">
                <!-- <label class="form-check-label" for="flexSwitchCheckChecked">Open</label> -->
            </div>

        </div>
        <hr>
        <div class="smalltxt text-muted fw-bold mt-4 mb-2">PAGES</div>
        <a href="index.php" class="text-decoration-none text-dark">
            <div class=" round-1  p-3 py-2 mb-2 profile-card mynav " id="nav-dash">
                <div class="d-flex justify-content-start align-items-center">
                    <div style="width: 40px" class=""><i class="fa-solid fa-boxes-stacked "></i></div>
                    <div class="h6 mb-0 fw-">Dashboard</div>
                </div>

            </div>
        </a>
        <a href="records.php" class="text-decoration-none text-dark">
            <div class=" round-1  p-3 py-2 mb-2 profile-card mynav" id="nav-records">
                <div class="d-flex justify-content-start align-items-center">
                    <div style="width: 40px" class=""><i class="fa-solid fa-book "></i></div>
                    <div class="h6 mb-0 fw-">Records</div>
                </div>

            </div>
        </a>
        <a href="account.php" class="text-decoration-none text-dark">
            <div class=" round-1 p-3 py-2 profile-card mynav" id="nav-account">
                <div class="d-flex justify-content-start align-items-center">
                    <div style="width: 40px" class=""><i class="fa-solid fa-user-gear"></i></div>
                    <div class="h6 mb-0 fw-">Account</div>
                </div>

            </div>
        </a>
        <hr>

    </div>
</div>

<script>
    var status = <?= $counter_status ?>;
    console.log(status);

    function changeStatus(id) {



        $.post('ajax/changeStatus.php', {
            id,
            status
        }, function(data) {

            if (data == 1) {
                $("#state").html(`<b class="text-success">OPEN</b>`);
                $("#master").removeClass('blurme');

            } else if (data == 2) {
                $("#state").html(`<b class="text-danger">CLOSED</b>`);
                $("#master").addClass('blurme');

            }

        });

        if (status == 1) {
            status = 2;
        } else if (status == 2) {
            status = 1;
        }

    }
</script>