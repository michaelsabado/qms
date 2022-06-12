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

        .mybtn {
            background-color: rgba(0, 0, 100, 0.1);
        }
    </style>
</head>

<body>
    <div class="d-flex ">
        <div class="vh-100  d-flex align-items-center flex-column justify-content-center" style="width: 40vw;">
            <div class="d-flex align-items-center">
                <div class="mb-3 me-4"><img src="../images/psu.png" height="100" alt=""></div>
                <div class="text-start">
                    <div class="h1 fw-bold">Welcome to PSU!</div>
                    <div class="h4 fw-">School of Advanced Studies</div>
                </div>

            </div>

            <div class="card border-0 w-100">
                <div class="card-body p-5">
                    <form action="" method="post" id="queue-form">
                        <div class="h6 fw-bold">1. Name / School ID</div>
                        <input type="text" name="identification" class="form-control form-control-lg mb-4 round-1" placeholder="Start here" value="" required>
                        <div class="h6 fw-bold">2. Select Program</div>
                        <!-- <div class="d-flex justify-content-stretch mb-4">
                            <div class="card text-center p-3 w-100 me-3 fw-bold mybtn round-1 shadow-sm" onclick="selectCounter($(this),2)">
                                Registrar
                            </div>
                            <div class="card text-center p-3 w-100 fw-bold mybtn round-1 shadow-sm" onclick="selectCounter($(this),1)">
                                Cashier
                            </div>
                        </div> -->
                        <select name="program" id="programs" class="form-select form-select-lg mb-4 round-1" required onchange="fetchMajor($(this).val())">
                            <option value="">- - -</option>
                            <?php

                            $sql = "SELECT * FROM program";
                            $res = $conn->query($sql);
                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                                    echo '<option value="' . $row['programid'] . '">' . $row['programdescription'] . '</option>';
                                }
                            }
                            ?>

                        </select>
                        <div class="h6 fw-bold">3. Select Major</div>

                        <select name="major" id="majors" class="form-select form-select-lg mb-4 round-1" required>


                        </select>

                        <div class="h6 fw-bold">4. Select Service</div>
                        <select class="form-select form-select-lg mb-2 round-1" required onchange="fetchServices($(this).val())">
                            <option value="">- - -</option>
                            <option value="1">Request</option>
                            <option value="2">Enrollment</option>
                            <option value="3">Application</option>
                            <option value="4">Claiming</option>
                            <option value="5">Submission</option>
                            <option value="6">Query & Others</option>
                        </select>
                        <select id="services" name="service" class="form-select form-select-lg mb-5 round-1" required>

                        </select>
                        <button type="submit" class="btn btn-lg w-100 btn-primary round-1 shadow" href="generate-number.php">5. Generate Number <i class="fas fa-angle-double-right"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="vh-100 p-3" style="width: 60vw;" id="right-panel">
            <div class="float-end">
                <div class="h1 fw-bold text-uppercase"><i class="fas fa-calendar-day me-2"></i><?= date("F d, Y") ?>
                </div>
            </div>
            <div class="h1 fw-bold mb-2" id="txt"></div>
            <?php
            $uploads = $conn->query("SELECT * FROM uploads WHERE isEnabled = 1 order by rand() ");
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


            $("#queue-form").submit(function(e) {
                e.preventDefault();

                $.post('generate-number.php', $("#queue-form").serialize(), function(data) {
                    // alert(data);
                    if (data == 102) {
                        alert("Service unavailable. Sorry for the inconvenience.");
                        $("#queue-form").reset();
                    } else {
                        $("#queue-form")[0].reset();
                        $(".mybtn").removeClass('text-white bg-success');

                        var strWindowFeatures = "location=yes,scrollbars=no,status=yes";
                        var URL = "print.php?id=" + data;
                        // var win = window.open(URL, "_blank", strWindowFeatures);

                        window.location.href = URL;
                    }


                });
            });


            function fetchServices(id) {

                $("#services").load('get-service.php', {
                    id
                }, function(data) {
                    // alert(data);
                })
            }

            function fetchMajor(id) {
                // alert(id);
                $("#majors").load('get-major.php', {
                    id
                }, function(data) {
                    // alert(data);
                })

            }




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