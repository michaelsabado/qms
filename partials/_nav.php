<div class="shadow-sm p-2 py-3 bg-white">
    <div class="d-flex justify-content-between align-items-center">
        <div>Status: <span id="state"><?= ($counter_status == 1) ? '<b class="text-success">OPEN</b>' : '<b class="text-danger">CLOSED</b>' ?></span></div>
        <div>
            <div class="h6 mb-0 fw- text-uppercase text-secondary ms-3"><i class="fas fa-calendar-day me-2"></i><?= date("F d, Y") ?>
            </div>
        </div>
        <div class="">
            <a href="../main/logout.php" class="btn btn-light shadow-sm text-danger round-1 px-3 float-end text-decoration-none">Logout <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>
</div>