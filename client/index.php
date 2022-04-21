<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>Get Queue</title>

</head>

<body>
    <div class="d-flex ">
        <div class="vh-100  d-flex align-items-center flex-column justify-content-center" style="width: 40vw;">
            <div class="mb-3"><img src="../images/psu.png" height="150" alt=""></div>
            <div class="h1 fw-bold">Welcome to PSU!</div>
            <div class="card border-0 w-100">
                <div class="card-body p-5">
                    <div class="h6 fw-bold">Name / School ID</div>
                    <input type="text" class="form-control form-control-lg mb-4 round-1" placeholder="XX-XX-XXXX" value="18-UR-0698">
                    <div class="d-flex justify-content-stretch mb-4">
                        <div class="card text-center p-3 bg-success text-white w-100 me-3 fw-bold mybtn round-1 shadow">
                            Registrar
                        </div>
                        <div class="card text-center p-3 w-100 fw-bold mybtn round-1 shadow">
                            Cashier
                        </div>
                    </div>
                    <div class="h6 fw-bold">Service</div>
                    <select name="" id="" class="form-select form-select-lg mb-5 round-1">
                        <option value="">Certificate of Grades</option>
                        <option value="">Apply for Graduation</option>
                    </select>

                    <a class="btn btn-lg w-100 btn-primary round-1 shadow" href="generate-number.php">Generate Number <i class="fas fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>

        <div class="vh-100 p-3" style="width: 60vw;" id="right-panel">
            <div class="float-end">
                <div class="h1 fw-bold text-uppercase"><i class="fas fa-calendar-day me-2"></i><?= date("F d, Y") ?>
                </div>
            </div>
            <div class="h1 fw-bold mb-2" id="txt">TEST</div>

            <div class="display-3 fw-bold text-center shadow-sm mb-5 bg-primary py-4" style="color: yellow; border-radius: 10px"><i class="fas fa-bell"></i> ANNOUNCEMENTS</div>
            <div class="round-1 overflow-hidden"> <video class="w-100 round-1" src='../videos/drone-shot.mp4' autoplay='true' muted='muted' loop></video></div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script>
            initialize();

            function initialize() {
                startTime();
                fetchupdate();
            }

            function startTime() {
                const today = new Date();
                let h = today.getHours();
                let m = today.getMinutes();
                let s = today.getSeconds();
                m = checkTime(m);
                s = checkTime(s);

                if (h < 12) {
                    e = "AM";

                    if (h == 0) {
                        h = 12;
                    }

                } else {
                    e = "PM";
                    h -= 12;
                }
                document.getElementById('txt').innerHTML = '<i class="fas fa-clock me-2"></i>' + h + ":" + m + " " + e;
                setTimeout(startTime, 1000);
            }



            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i
                }; // add zero in front of numbers < 10
                return i;
            }
        </script>
</body>

</html>