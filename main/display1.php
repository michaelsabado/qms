<?php
session_start();
include '../database/dbconfig.php';





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>Display</title>
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

        .display-1 {
            font-size: 7rem;
        }

        .br {
            border-radius: 10px;

        }
    </style>
</head>

<body>


    <div class="d-flex justify-content-center align-items-center" id="f">
        <div>
            <button class="btn btn-light btn-lg round-1 shadow" onclick="startMe()"> Load Display <i class="fas fa-download"></i></button>
        </div>

    </div>
    <audio src="../audio/call3.mp3" class="d-none" id="callaudio" controls></audio>
    <button type="button" id="trigger-audio" class="d-none" onclick="document.getElementById('callaudio').play()">Play</button>

    <div class="d-flex ">
        <div class="vh-100 p-2 px-3" style="width: 50vw;">
            <!-- <div class="d-flex align-items-center mb-3">
                <div class="me-3">
                    <img src="../images/psu.png" height="70" alt="">
                </div>
                <div class="display-3 fw-bold ">NOW SERVING</div>
            </div> -->


            <div class="d-flex flex-column justify-content-between " style="height: calc(100vh - 20px)">
                <div class="div d-flex align-items-center justify-content-around round-1 shadow" style=" background-color: yellow">

                    <div class="display-2 fw-bold text-center w-100 h-100  py-3" style="border-right: 3px solid #333">WINDOW</div>
                    <div class="display-2 fw-bold text-center w-100 h-100 py-3">SERVING</div>

                </div>
                <?php


                $sql = "SELECT * FROM counter";

                $res = $conn->query($sql);



                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {

                ?>

                        <div class="div d-flex align-items-center justify-content-around" style="height: 100%; border: 4px solid transparent">

                            <div class="w-100 h-100 bg-light d-flex align-items-center shadow-sm round-1 justify-content-center">
                                <div class="display-1 fw-bold">
                                    <?= $row['windowno'] ?></div>
                            </div>


                            <div class="w-100 h-100 bg-primary d-flex align-items-center justify-content-between br shadow round-1">


                                <div class="display-2 fw-bold text-white text-center  tokens" id="c<?= $row['windowno'] ?>-ns" style="width: 60%">-
                                </div>

                                <div class="display-2 fw-bold p-1 tokens text-center" id="window<?= $row['windowno'] ?>" style="width: 40%; max-height: 100%; height: 100%; overflow-y: hidden; background-color: rgba(250,250,250,0.5)">
                                </div>



                            </div>

                        </div>
                <?php
                    }
                }



                ?>
            </div>


        </div>

        <div class="vh-100 p-3" id="right-panel" style="width: 50vw;">
            <div class="float-end">
                <div class="display-5 fw-bold text-uppercase"><i class="fas fa-calendar-day me-2"></i><?= date("F d, Y") ?>
                </div>
            </div>
            <div class="display-5 fw-bold mb-2" id="txt"></div>
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


                for (var x = 0; x < 4; x++) {
                    e.fadeOut(500);
                    e.fadeIn(500);
                }

            }


            $('document').ready(function() {
                function speak(message) {
                    var msg = new SpeechSynthesisUtterance(message)
                    var voices = window.speechSynthesis.getVoices()
                    msg.voice = voices[0]
                    window.speechSynthesis.speak(msg)
                }
                setInterval(function() {




                    $.post('ajax/checkCounter.php', function(data1) {


                        var counter = JSON.parse(data1);
                        console.log(counter);

                        for (var y = 0; y < counter.length; y++) {
                            var next_count = 0;
                            $('#window' + counter[y].windowno).text('');
                            $("#c" + counter[y].windowno + "-ns").text("-");
                            $.ajax({
                                type: "POST",
                                url: 'ajax/fetch-queue.php',
                                data: {
                                    id: counter[y].counterid
                                },
                                async: false,
                                success: function(data) {
                                    var queues = JSON.parse(data);




                                    $("c" + counter[y].windowno + "-ns").text('-');
                                    var c1 = 0;

                                    console.log(queues);

                                    for (var x = 0; x < queues.length; x++) {
                                        var queue = JSON.parse(queues[x]);


                                        if ((c1 == 0 && queue.iscalled == 1) || queue.iscalled == 2) {
                                            console.log('Hello');
                                            $("#c" + counter[y].windowno + "-ns").text(queue.token);
                                            $("#c" + counter[y].windowno + "-ident").text(queue.identification);
                                            c1++;

                                            if (queue.iscalled == 1) {
                                                // console.log(queue);
                                                var message = queue.token.split('').join(' ');
                                                message += ", window " + counter[y].windowno;

                                                $.ajax({
                                                    type: "POST",
                                                    url: 'ajax/called_queue.php',
                                                    data: {
                                                        queueid: queue.queueid
                                                    },
                                                    async: false,
                                                    success: function(data) {

                                                        document.getElementById("callaudio").pause();
                                                        document.getElementById("callaudio").currentTime = 0;

                                                        // console.log(queue);
                                                        // console.log('Counter 2: ' + queue.queueid);
                                                        $("#trigger-audio").click();
                                                        setTimeout(function() {
                                                            speak(message);
                                                        }, 2500)

                                                        blink_text($("#c" + counter[y].windowno + "-ns"));
                                                    }
                                                });



                                                $.post('ajax/called_queue.php', {
                                                    queueid: queue.queueid
                                                }, function(data) {

                                                    // blink_text($("#c" + counter[y].windowno + "-ident"));
                                                });
                                            };

                                        } else {
                                            next_count++;
                                            var element;
                                            if (next_count <= 3) {
                                                element = `  <div class="card mb-1 bg-light shadow-sm border-0 round-1">
                                                    <div class="card-body py-1">
                                                        <div class="h4 mb-0 fw-bold text-center">` + queue.token + `</div>
                                                    </div>
                                                </div>`;
                                                $('#window' + counter[y].windowno).append(element);
                                            } else if (next_count == 4) {

                                                element = ` <div class="card mb-1 bg-light shadow-sm border-0 round-1">
                                                    <div class="card-body py-0">
                                                       <div class="h6 mb-0"><i class="fas fa-ellipsis-h"></i></>
                                                    </div>
                                                </div>`;
                                                $('#window' + counter[y].windowno).append(element);
                                            }



                                        }




                                    }
                                }
                            });

                            if (counter[y].status == 2) {
                                $("#c" + counter[y].windowno + "-ns").html("<div class='display-5 fw-bold mt-2' style='color: rgba(250,250,250,0.6)'>CLOSED</div>");
                                //     $("#c1-ident").text('');
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