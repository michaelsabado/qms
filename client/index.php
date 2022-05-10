<?php
session_start();
include '../database/dbconfig.php';
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>Get Queue</title>
    <style>
        .slideShow {
            display: flex;
            justify-content: center;
            align-items: center;
            width: calc(100%);
            height: calc(100vh - 100px);
            padding: auto;
        }

        .slideShow img,
        .slideShow video {
            max-width: calc(100%);
            max-height: calc(100%);
            opacity: 0;
            transition: all .5s ease-in-out;
        }

        .slideShow video {
            width: calc(100%);
        }
    </style>
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
            <?php
            $uploads = $conn->query("SELECT * FROM uploads order by rand() ");
            $slides = array();
            while ($row = $uploads->fetch_assoc()) {
                $slides[] = $row['file_name'];
            }
            ?>
            <div class="slideShow">

            </div>
        </div>
        <?php include '../partials/_footer.php' ?>
        <script>
            initialize();

            function initialize() {
                startTime();
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


            var slides = <?php echo json_encode($slides) ?>;
            var scount = slides.length;
            if (scount > 0) {
                $(document).ready(function() {
                    render_slides(0)
                })
            }

            function render_slides(k) {
                if (k >= scount)
                    k = 0;
                var src = slides[k]
                k++;
                var t = src.split('.');
                var file;
                t = t[1];
                if (t == 'mp4') {
                    file = $("<video id='slide' src='../uploads/" + src + "' onended='render_slides(" + k + ")' autoplay='true' muted='muted'></video>");
                } else {
                    file = $("<img id='slide' src='../uploads/" + src + "' onload='slideInterval(" + k + ")' />");
                }
                console.log(file)
                if ($('#slide').length > 0) {
                    $('#slide').css({
                        "opacity": 0
                    });
                    setTimeout(function() {
                        $('.slideShow').html('');
                        $('.slideShow').append(file)
                        $('#slide').css({
                            "opacity": 1
                        });
                        if (t == 'mp4')
                            $('video').trigger('play');


                    }, 500)
                } else {
                    $('.slideShow').append(file)
                    $('#slide').css({
                        "opacity": 1
                    });

                }

            }

            function slideInterval(i = 0) {
                setTimeout(function() {
                    render_slides(i)
                }, 4000)

            }
        </script>
</body>

</html>