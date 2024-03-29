<?php
session_start();
include '../database/dbconfig.php';


if (!isset($_SESSION['user']) || $_SESSION['user']['usertype'] != 2) {
    header("Location: ../main/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>Window <?= $_SESSION['user']['windowno'] ?></title>
    <style>
        .cb {
            border: 3px solid white;

        }

        .cb:hover {
            border: 3px dotted #555;
        }
    </style>
</head>

<body class="bg-light">


    <div class="d-flex ">
        <?php include '../partials/_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include '../partials/_nav.php' ?>

            <div class="content p-5">
                <div class="h4 fw-  mb-4"><i class="fa-solid fa-boxes-stacked me-3"></i>Dashboard</div>

                <div class="row <?= ($_SESSION['user']['status'] == 2) ? "blurme" : "" ?>" id="master">
                    <div class="col-md-8">
                        <div class="card round-2 shadow-sm  mb-3" style="   border: 3px solid rgb(13, 110, 253);">
                            <div class="card-body p-4">
                                <div class="float-end">
                                    <button class=" btn btn-light shadow-sm border  round-1 me-2" onclick="reQueue()"><i class="fas fa-retweet    "></i> Re-Queue</button> <button class="float-end btn btn-light shadow-sm border  round-1" onclick="breakQueue()"><i class="fas fa-stopwatch"></i> Break Queue</button>
                                </div>
                                <div class="h5 fw-bold text-primary">Now Serving</div>
                                <div class="text- fw- mb-0" style="font-size: 80px;" id="c1-ns">
                                    <div class="spinner-grow text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="w-100">
                                        <div class="h6"><b>Client</b>: <span id="c1-ident">-</span></div>
                                        <div class="h6"><b>Purpose</b>: <span id="c1-type">-</span> | <span id="c1-service">-</span></div>

                                    </div>
                                    <div class="w-100">
                                        <!-- <div class="h6"><b>Service</b>: </div> -->
                                        <div class="h6"><b>Program</b>: <span id="c1-program">-</span></div>
                                        <div class="h6"><b>Major</b>: <span id="c1-major">-</span></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card round-2 shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="h6 fw-bold text-primary mb-4">Controls</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card p-2 align-items-center shadow text-center bg-primary mb-3 round-1 pointer cb" data-bs-toggle="offcanvas" id="open-canvass" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" onclick="fetchCounter()">
                                            <div class="h5 text-white mb-0">Transfer <i class="fas fa-exchange-alt"></i></div>
                                            <div class="smalltxt text-white">(Shift + T)</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card  p-2 align-items-center shadow text-center bg-success mb-3 pointer round-1 cb" onclick="callnext()">
                                            <div class="h5 text-white mb-0 ">Call Next <i class="fas fa-angle-double-right"></i></div>
                                            <div class="smalltxt text-white">(Shift + C)</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card p-2 align-items-center shadow text-center bg-warning mb-3 round-1 pointer cb" onclick="recall()">
                                            <div class="h5 text-white mb-0 ">Recall <i class="fas fa-redo"></i></div>
                                            <div class="smalltxt text-white">(Shift + R)</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card  p-2 align-items-center shadow text-center bg-danger mb-3 pointer round-1 cb" onclick="voidMe()">
                                            <div class="h5 text-white mb-0">Void <i class="fas fa-ban"></i></div>
                                            <div class="smalltxt text-white">(Shift + V)</div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card round-2 shadow-sm border-0 mb-3">
                            <div class="card-body p-3">
                                <div class="card bg-light border-0 mb-3 shadow-sm round-1">
                                    <div class="card-body">
                                        <div class="h6 fw-">Total Served</div>
                                        <div class="h2 text- fw-bold text-end mb-0 text-dark" id="served">0</div>
                                    </div>
                                </div>
                                <div class="card bg-light border-0 mb-3 shadow-sm round-1">
                                    <div class="card-body">
                                        <div class="h6 fw- text-">Pending Clients</div>
                                        <div class="h2 text- fw-bold text-end mb-0 text-dark" id="pending">0</div>

                                    </div>
                                </div>
                                <div class="card border-0 shadow-sm round-1">
                                    <div class="card-body">
                                        <div class="h6 fw-bold text-center text-success mb-3"><i class="fas fa-angle-double-down me-2"></i>Next Clients <i class="fas fa-angle-double-down ms-1"></i></div>
                                        <ul class="list-group list-group-flush" id="nextqueue" style="height: 208px; overflow-y: auto">
                                            <div class="spinner-grow text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>





            </div>


            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Transfer Client</h5>
                    <button type="button" id="close-canvass" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" id="show-counter">



                </div>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight1" aria-labelledby="offcanvasRightLabel1">
                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel1">Transfer Client</h5>
                    <button type="button" id="close-canvass1" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" id="show-counter1">



                </div>
            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $("#nav-dash").addClass('mynav-active');

                var currenttoken = 0;
                var nexttoken = 0;
                var currenttoken_data;
                var majorid;
                var queueTransfer = 0;
                var majorTransfer;

                function fetchCounter() {
                    $("#show-counter").load('ajax/fetch-counter.php');
                }

                function fetchCounter1(qq) {
                    // alert(qq);
                    $("#show-counter1").load('ajax/fetch-counter1.php');
                    queueTransfer = qq;
                    // majorTransfer = major;


                }


                document.addEventListener("keydown", function(e) {
                    if ($('#toggleState').is(":checked")) {
                        if (e.keyCode == 67 && e.shiftKey == true) callnext();
                        if (e.keyCode == 86 && e.shiftKey == true) voidMe();
                        if (e.keyCode == 82 && e.shiftKey == true) recall();
                        if (e.keyCode == 86 && e.shiftKey == true) voidMe();
                        if (e.keyCode == 84 && e.shiftKey == true) $("#open-canvass").click();
                    }
                })


                function recall() {

                    if (currenttoken != 0) {
                        Swal.fire({
                            title: 'Recall token?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.post('ajax/recall.php', {
                                    id: currenttoken
                                }, function(data) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Token Recalled',
                                        showConfirmButton: false,
                                        timer: 1000
                                    })
                                });



                            }
                        })
                    } else {
                        Swal.fire(
                            'Oops!',
                            'Nothing to recall',
                            'info'
                        )
                    }



                }

                function callnext() {
                    if (nexttoken == 0) {
                        Swal.fire(
                            'Oops!',
                            'No pending client.',
                            'info'
                        )
                    } else {
                        Swal.fire({
                            title: 'Call next token?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then((result) => {
                            if (result.isConfirmed) {



                                $.post('ajax/callnext.php', {
                                    currenttoken,
                                    nexttoken
                                }, function(data) {
                                    // alert(data);
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Called',
                                        showConfirmButton: false,
                                        timer: 1000
                                    })
                                });


                            }
                        })
                    }



                }

                function prio(priotoken) {
                    if (nexttoken == 0) {
                        Swal.fire(
                            'Oops!',
                            'No pending client.',
                            'info'
                        )
                    } else {
                        Swal.fire({
                            title: 'Prioritize this token?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then((result) => {
                            if (result.isConfirmed) {

                                // alert("This is: " + active);

                                $.post('ajax/prioritize.php', {
                                    active,
                                    currenttoken,
                                    priotoken
                                }, function(data) {
                                    // alert(data);
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Client prioritized',
                                        showConfirmButton: false,
                                        timer: 1000
                                    })
                                });


                            }
                        })
                    }



                }


                function breakQueue() {
                    if (active == 0) {
                        Swal.fire(
                            'Oops!',
                            'You have no active client. You can take your break now 😊',
                            'success'
                        )
                    } else {
                        Swal.fire({
                            title: 'Take a break?',
                            text: 'Make sure to finish current token.',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, I\'m done'
                        }).then((result) => {
                            if (result.isConfirmed) {



                                $.post('ajax/breakQueue.php', {
                                    currenttoken
                                }, function(data) {
                                    // alert(data);
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Queue Paused',
                                        showConfirmButton: false,
                                        timer: 1000
                                    })
                                });
                                active = 0;
                                nexttoken = 0;
                                currenttoken = 0;


                            }
                        })
                    }



                }

                function voidMe() {
                    if (currenttoken != 0) {
                        Swal.fire({
                            title: 'Void token?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.post('ajax/void.php', {
                                    currenttoken,
                                    nexttoken
                                }, function(data) {

                                });
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Token voided',
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })

                    } else {
                        Swal.fire(
                            'Oops!',
                            'Nothing to void',
                            'info'
                        )
                    }

                }

                function reQueue() {




                    if (active != 0) {
                        Swal.fire({
                            title: 'Re-Queue Client?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.post('ajax/requeue.php', {
                                    currenttoken: currenttoken_data,
                                    majorid: majorid
                                }, function(data) {
                                    // alert(data)

                                    $("#close-canvass").click();
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Client Re-Queued',
                                        showConfirmButton: false,
                                        timer: 1000
                                    })

                                    active = 0;
                                });
                            }
                        })
                    } else {
                        Swal.fire(
                            'Oops!',
                            'Nothing to re-queue',
                            'info'
                        )
                    }

                }



                function voidToken(id) {

                    Swal.fire({
                        title: 'Void token?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('ajax/void.php', {
                                currenttoken: id,
                                nexttoken: nexttoken
                            }, function(data) {

                            });
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Token voided',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                    })



                }

                function transferMe(counter) {
                    if (currenttoken != 0) {
                        $.post('ajax/transfer.php', {
                            counterid: counter,
                            currenttoken: currenttoken_data,
                            nexttoken: nexttoken,
                            majorid: majorid
                        }, function(data) {
                            // alert(data)

                            $("#close-canvass").click();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Client transferred',
                                showConfirmButton: false,
                                timer: 1000
                            })

                            active = 0;
                        });
                    } else {
                        Swal.fire(
                            'Oops!',
                            'Nothing to transfer',
                            'info'
                        )
                    }

                }


                function transferToken(counter) {
                    // alert(tokenTransfer);
                    if (queueTransfer != 0) {
                        $.post('ajax/transfer1.php', {
                            counterid: counter,
                            currenttoken: queueTransfer
                        }, function(data) {
                            // alert(data)

                            $("#close-canvass1").click();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Client transferred',
                                showConfirmButton: false,
                                timer: 1000
                            })

                            majorTransfer = 0;
                        });
                    } else {
                        Swal.fire(
                            'Oops!',
                            'Nothing to transfer',
                            'info'
                        )
                    }

                }
                const browserTitle = document.title;
                var active = 0;
                var pending = 0;
                var served = 0;

                var isblink = 0;
                setInterval(function() {
                    pending == 0;

                    $.post('ajax/fetch-queue.php', function(data) {
                        var queues = JSON.parse(data);

                        $('#nextqueue').html('');
                        $('#c1-ns').text('-');
                        $('#c1-ident').text('-');
                        $('#c1-service').text('-');
                        $('#c1-type').text('-');
                        $('#c1-program').text('-');
                        $('#c1-major').text('-');
                        var c1 = 0;
                        var c2 = 0;
                        pending = 0;
                        served = 0;
                        $("#pending").text(pending);

                        for (var x = 0; x < queues.length; x++) {
                            var queue = JSON.parse(queues[x]);



                            if (queue.status == 2) {
                                var date = queue.date_created.split(" ");
                                if (date[0] == '<?= date("Y-m-d") ?>') {
                                    served++;
                                    $("#served").text(served);
                                }
                            } else if (queue.status == 1) {
                                if ((c1 == 0 && queue.iscalled == 1) || queue.iscalled == 2) {
                                    active = 1;
                                    $("#c1-ns").text(queue.token);
                                    $("#c1-ident").text(queue.identification);
                                    $('#c1-service').text(queue.description);

                                    $('#c1-major').text(queue.majordescription);
                                    var type = '';

                                    switch (queue.category) {
                                        case '1':
                                            type = 'Request';
                                            break;
                                        case '2':
                                            type = 'Enrollment';
                                            break;
                                        case '3':
                                            type = 'Application';
                                            break;
                                        case '4':
                                            type = 'Claiming';
                                            break;
                                        case '5':
                                            type = 'Submission';
                                            break;
                                        case '6':
                                            type = 'Query & Others';
                                            break;
                                    }

                                    $('#c1-type').text(type);
                                    $('#c1-program').text(queue.programdescription);
                                    currenttoken = queue.queueid;
                                    currenttoken_data = queue;
                                    majorid = queue.majorid
                                    c1++;

                                } else {
                                    pending++;
                                    $("#pending").text(pending);

                                    if (c2 == 0) {
                                        nexttoken = queue.queueid;

                                        c2++;
                                    }

                                    var element = ` <li class="list-group-item  text-center bg-light  mb-3">
                                        <div class="d-flex justify-content-between">
                                            <div><i class="fas fa-ban pointer text-danger h5 mb-0" onclick="voidToken(` + queue.queueid + `)"></i></div>
                                            <div class="h5 mb-0 fw-bold">` + queue.token + `<div class="smalltxt fw-light">` + queue.identification + `</div><div class="smalltxt fw-light">` + queue.programdescription + `</div><div class="smalltxt fw-light" style="font-size: 11px">Major in ` + queue.majordescription + `</div></div>
                                            <div><i class="fas fa-running pointer text-primary h5 mb-0" onclick="prio(` + queue.queueid + `)"></i></div>
                                            
                                        </div><div class="text-end smalltxt mt-2 text-success pointer"  data-bs-toggle="offcanvas" id="open-canvass1" data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight1" onclick="fetchCounter1(` + queue.queueid + `)">Transfer <i class="fas fa-arrow-circle-right ms-2 pointer text-success "></i></div>
                                    </li> `;

                                    $('#nextqueue').append(element);
                                }


                                if (pending == 0) nexttoken = 0;

                            }







                        }



                    });

                    // let timeoutId;
                    // let message = "You have client";

                    // const stopBlinking = () => {
                    //     document.title = browserTitle;

                    // };

                    // const startBlinking = () => {

                    //     document.title = document.title === message ? browserTitle : message;
                    // };
                    // console.log(isblink);
                    // if (isblink == 1) {
                    //     // const browserTitle = document.title;
                    //     if (pending != 0) {
                    //         startBlinking()
                    //     } else {
                    //         stopBlinking();
                    //     }
                    //     // function registerEvents() {
                    //     //     window.addEventListener("focus", function(event) {

                    //     //         stopBlinking();
                    //     //     });

                    //     //     window.addEventListener("blur", function(event) {
                    //     //         if (pending != 0) {
                    //     //             timeoutId = setInterval(startBlinking, 200);
                    //     //         }
                    //     //     });


                    //     // };

                    //     // registerEvents();

                    //     // if (pending != 0) {
                    //     //     timeoutId = setInterval(startBlinking, 200);
                    //     // }
                    // } else {
                    //     stopBlinking();
                    // }

                }, 1000)


                // window.addEventListener("blur", function(event) {

                //     isblink == 1;

                // });
                // window.addEventListener("focus", function(event) {

                //     isblink == 0;
                // });
            </script>
</body>

</html>