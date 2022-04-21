<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>Get Queue</title>

</head>

<body>
    <div class="d-flex ">
        <div class="vh-100 p-2 px-3" style="width: 40vw;">
            <div class="d-flex align-items-center mb-3">
                <div class="me-3">
                    <img src="../images/psu.png" height="70" alt="">
                </div>
                <div class="display-3 fw-bold ">REGISTRAR</div>
            </div>


            <div class="card border-0 shadow-sm round-2" style="background-color: yellow; ">
                <div class="card-body">
                    <div class="display-6 text-center">Now Serving</div>
                    <div class="text-center fw-bold" style="font-size: 90px">1003</div>
                    <div class="text-center" style="font-size: 30px">18-UR-0698</div>
                </div>
            </div>
            <div class="h2 mt-5 fw-bold text-center  mb-3"><i class="fas fa-angle-double-down me-2"></i>Next Token <i class="fas fa-angle-double-down ms-1"></i></div>

            <div class="card mb-3 bg-light shadow-sm border-0 round-1">
                <div class="card-body">
                    <div class="h2 mb-0 fw-bold text-center">1004</div>
                </div>
            </div>
            <div class="card mb-3 bg-light shadow-sm border-0 round-1">
                <div class="card-body">
                    <div class="h2 mb-0 fw-bold text-center">1007</div>
                </div>
            </div>

        </div>

        <div class="vh-100 p-3" id="right-panel" style="width: 60vw;">
            <div class="float-end">
                <div class="h1 fw-bold text-uppercase"><i class="fas fa-calendar-day me-2"></i><?= date("F d, Y") ?>
                </div>
            </div>
            <div class="h1 fw-bold mb-2" id="txt">TEST</div>
            <div style="height: calc(100vh - 100px)" class="text-center">
                <img src="../uploads/anc3.png" class="h-100" class="bg-danger">
            </div>
            <!-- <div class="display-3 fw-bold text-center shadow-sm mb-5 bg-primary py-4" style="color: yellow; border-radius: 10px"><i class="fas fa-bell"></i> ANNOUNCEMENTS</div> -->
            <!-- <video class="w-100 round-2" src='../videos/drone-shot.mp4' autoplay='true' muted='muted' loop></video> -->
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