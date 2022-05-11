<?php
session_start();
include '../database/dbconfig.php';


if (!isset($_SESSION['user'])) {
    header("Location: ../main/login.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>Get Queue</title>
    <style>
        body {
            overflow-y: hidden;
        }

        #f {
            position: fixed;
            height: 100vh;
            width: 100vw;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(20px);
            z-index: 10;
        }

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


    <div class="d-flex justify-content-center align-items-center" id="f">
        <div>
            <button class="btn btn-light btn-lg round-1 shadow" onclick="startMe()"> Load Display <i class="fas fa-download"></i></button>
        </div>

    </div>
    <audio src="../audio/call.mp3" class="d-none" id="callaudio" controls></audio>
    <button type="button" id="trigger-audio" class="d-none" onclick="document.getElementById('callaudio').play()">Play</button>

    <div class="d-flex ">
        <div class="vh-100 p-2 px-3" style="width: 50vw;">
            <div class="d-flex align-items-center mb-3">
                <div class="me-3">
                    <img src="../images/psu.png" height="70" alt="">
                </div>
                <div class="display-3 fw-bold ">NOW SERVING</div>
            </div>


            <div class="card border-0 shadow-sm round-2" style="background-color: yellow; ">
                <div class="card-body">

                    <div class="row">
                        <div class="col" style="border-right: 2px solid black;">
                            <div class="text-center fw-bold" style="font-size: 40px">REGISTRAR</div>
                            <div class="text-center fw-bold" style="font-size: 100px" id="c1-ns">-</div>
                            <div class="text-center" style="font-size: 30px" id="c1-ident">-</div>
                        </div>
                        <div class="col">
                            <div class="text-center fw-bold" style="font-size: 40px">CASHIER</div>
                            <div class="text-center fw-bold" style="font-size: 100px" id="c2-ns">-</div>
                            <div class="text-center" style="font-size: 30px" id="c2-ident">-</div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="h2 mt-5 fw-bold text-center  mb-3"><i class="fas fa-angle-double-down me-5"></i>Next Token <i class="fas fa-angle-double-down ms-5"></i></div>
            <div class="row">
                <div class="col" id="counter1">


                </div>
                <div class="col" id="counter2">

                </div>
            </div>


        </div>

        <div class="vh-100 p-3" id="right-panel" style="width: 50vw;">
            <div class="float-end">
                <div class="h1 fw-bold text-uppercase"><i class="fas fa-calendar-day me-2"></i><?= date("F d, Y") ?>
                </div>
            </div>
            <div class="h1 fw-bold mb-2" id="txt"></div>
            <?php
            $uploads = $conn->query("SELECT * FROM uploads  WHERE isEnabled = 1 order by rand() ");
            $slides = array();
            while ($row = $uploads->fetch_assoc()) {
                $slides[] = $row['file_name'];
            }
            ?>
            <div class="slideShow">

            </div>
            <!-- <div class="display-3 fw-bold text-center shadow-sm mb-5 bg-primary py-4" style="color: yellow; border-radius: 10px"><i class="fas fa-bell"></i> ANNOUNCEMENTS</div> -->
            <!-- <video class="w-100 round-2" src='../videos/drone-shot.mp4' autoplay='true' muted='muted' loop></video> -->
        </div>

        <?php include '../partials/_footer.php' ?>
        <script>
            function startMe() {
                $("#f").remove();
            }

            function blink_text(e) {


                for (var x = 0; x < 3; x++) {
                    e.fadeOut(500);
                    e.fadeIn(500);
                }

            }
            $('document').ready(function() {

                setInterval(function() {

                    $.post('ajax/fetch-queue.php', function(data) {
                        var queues = JSON.parse(data);

                        $('#counter1').html('');
                        $('#counter2').html('');
                        $('#c1-ns').text('-');
                        $('#c2-ns').text('-');
                        $('#c1-ident').text('-');
                        $('#c2-ident').text('-');
                        var c1 = 0;
                        var c2 = 0;

                        for (var x = 0; x < queues.length; x++) {
                            var queue = JSON.parse(queues[x]);

                            if (queue.counterid == 2) {

                                if ((c1 == 0 && queue.iscalled == 1) || queue.iscalled == 2) {
                                    $("#c1-ns").text(queue.token);
                                    $("#c1-ident").text(queue.identification);
                                    c1++;

                                    if (queue.iscalled == 1) {


                                        $.post('ajax/called_queue.php', {
                                            queueid: queue.queueid
                                        }, function(data) {
                                            document.getElementById("callaudio").pause();
                                            document.getElementById("callaudio").currentTime = 0;
                                            $("#trigger-audio").click();

                                            blink_text($("#c1-ns"));
                                            blink_text($("#c1-ident"));
                                        });
                                    };

                                } else {
                                    var element = `  <div class="card mb-3 bg-light shadow-sm border-0 round-1">
                                            <div class="card-body">
                                                <div class="h2 mb-0 fw-bold text-center">` + queue.token + `</div>
                                            </div>
                                        </div>`;

                                    $('#counter1').append(element);
                                }




                            } else if (queue.counterid == 1) {
                                if ((c2 == 0 && queue.iscalled == 1) || queue.iscalled == 2) {
                                    $("#c2-ns").text(queue.token);
                                    $("#c2-ident").text(queue.identification);
                                    c2++;

                                    if (queue.iscalled == 1) {

                                        $.post('ajax/called_queue.php', {
                                            queueid: queue.queueid
                                        }, function(data) {
                                            document.getElementById("callaudio").pause();
                                            document.getElementById("callaudio").currentTime = 0;
                                            $("#trigger-audio").click();

                                            blink_text($("#c2-ns"));
                                            blink_text($("#c2-ident"));
                                        });
                                    };
                                } else {
                                    var element = `  <div class="card mb-3 bg-light shadow-sm border-0 round-1">
                                    <div class="card-body">
                                        <div class="h2 mb-0 fw-bold text-center">` + queue.token + `</div>
                                    </div>
                                </div>`;

                                    $('#counter2').append(element);
                                }
                            }
                        }
                    });


                }, 1000)
            });



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