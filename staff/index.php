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
                                <div class="h5 fw-bold text-primary">Now Serving</div>
                                <div class="text- fw- mb-0" style="font-size: 80px;" id="c1-ns">
                                    <div class="spinner-grow text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="h6"><b>Client</b>: <span id="c1-ident">-</span></div>
                                <div class="h6"><b>Service</b>: <span id="c1-service">-</span></div>
                            </div>
                        </div>
                        <div class="card round-2 shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="h6 fw-bold text-primary mb-4">Controls</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card p-2 align-items-center shadow text-center bg-primary mb-3 round-1 pointer cb" data-bs-toggle="offcanvas" id="open-canvass" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
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
                    <h5 id="offcanvasRightLabel">Transfer token</h5>
                    <button type="button" id="close-canvass" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <?php
                    $res = $conn->query("SELECT * FROM counter WHERE counterid != " . $_SESSION['user']['counterid']);


                    if ($res->num_rows > 0) {


                        while ($row = $res->fetch_assoc()) {

                            if ($row['status'] == 1) {
                                $status = "Open";
                            } else {
                                $status = "Closed";
                            }


                            echo '<div class="card round-1 pointer shadow-sm bg-light mb-3 cb"  onclick="transferMe(' . $row['counterid'] . ')">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="h1 mb-0 fw-"> <i class="fa-solid fa-window-maximize me-3"></i>
                                                    </div>
                                                    <div>
                                                        <div class="h5 mb-0 fw-bold">
                                                            ' . $row['countername'] . '
                                                        </div>
                                                        <div class="smalltxt">Status: ' . $status . '</div>
                                                    </div>
                                                  
                                                </div>
                                            </div>
                                        </div>';
                        }
                    }
                    ?>


                </div>
            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $("#nav-dash").addClass('mynav-active');

                var currenttoken = 0;
                var nexttoken = 0;
                var currenttoken_data;


                document.addEventListener("keydown", function(e) {
                    if (e.keyCode == 67 && e.shiftKey == true) callnext();
                    if (e.keyCode == 86 && e.shiftKey == true) voidMe();
                    if (e.keyCode == 82 && e.shiftKey == true) recall();
                    if (e.keyCode == 86 && e.shiftKey == true) voidMe();
                    if (e.keyCode == 84 && e.shiftKey == true) $("#open-canvass").click();
                })


                function recall() {
                    Swal.fire({
                        title: 'Recall token?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (currenttoken != 0) {
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
                            } else {
                                Swal.fire(
                                    'Oops!',
                                    'Nothing to call',
                                    'info'
                                )
                            }



                        }
                    })


                }

                function callnext() {
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

                            if (nexttoken == 0) {
                                Swal.fire(
                                    'Oops!',
                                    'Nothing to call',
                                    'info'
                                )
                            }

                        }
                    })


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

                function transferMe(counter) {
                    if (currenttoken != 0) {
                        $.post('ajax/transfer.php', {
                            counterid: counter,
                            currenttoken: currenttoken_data,
                            nexttoken: nexttoken
                        }, function(data) {
                            // alert(data)

                            $("#close-canvass").click();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Token transferred',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        });
                    } else {
                        Swal.fire(
                            'Oops!',
                            'Nothing to transfer',
                            'info'
                        )
                    }

                }



                var pending = 0;
                var served = 0;
                setInterval(function() {


                    $.post('ajax/fetch-queue.php', function(data) {
                        var queues = JSON.parse(data);

                        $('#nextqueue').html('');
                        $('#c1-ns').text('-');
                        $('#c1-ident').text('-');
                        $('#c1-service').text('-');
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

                                    $("#c1-ns").text(queue.token);
                                    $("#c1-ident").text(queue.identification);
                                    $('#c1-service').text(queue.description);
                                    currenttoken = queue.queueid;
                                    currenttoken_data = queue;
                                    c1++;

                                } else {
                                    pending++;
                                    $("#pending").text(pending);

                                    if (c2 == 0) {
                                        nexttoken = queue.queueid;

                                        c2++;
                                    }

                                    var element = ` <li class="list-group-item  text-center bg-light  mb-1">
                                        <div class="d-flex justify-content-between">
                                            <div></div>
                                            <div class="h6 mb-0 fw-bold">` + queue.token + `</div>
                                            <div><i class="far fa-caret-square-down"></i></div>
                                        </div>
                                    </li> `;

                                    $('#nextqueue').append(element);
                                }
                            }







                        }

                    });



                }, 1000)
            </script>
</body>

</html>