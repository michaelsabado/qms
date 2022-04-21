<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'partials/_header.php' ?>
    <title>Counter</title>

</head>

<body class="bg-light">




    <div class="d-flex ">
        <?php include 'partials/_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include 'partials/_nav.php' ?>

            <div class="content p-5">
                <div class="h4 fw-  mb-4"><i class="fas fa-book me-3 "></i>Records</div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card round-1 shadow-sm border-0 mb-3">
                            <div class="card-body p-4">
                                <div class="h5 fw-bold text-primary">Now Serving</div>
                                <div class="text- fw- mb-0" style="font-size: 90px;">1003</div>
                                <div class="h6"><b>Client</b>: 18-UR-0698</div>
                                <div class="h6"><b>Service</b>: Application for Graduation</div>
                            </div>
                        </div>


                    </div>

                </div>

                <!-- 
            <div class="card shadow-sm mb-5 mt-3" style="border-radius: 15px; overflow: hidden">
                <div class="card-header py-4" style="background: yellow">
                    <div class="display-6 text-center text-dark">Currently Serving</div>
                </div>
                <div class="card-body">

                    <div class="text-center fw-bold" style="font-size: 150px;">1003</div>
                    <div class="text-center" style="font-size: 40px">18-UR-0698</div>
                </div>
            </div>




            <div class="row">
                <div class="col-6">


                    <div class="card shadow-sm" style="border-radius: 15px; ">
                        <div class="card-body">
                            <div class="h4 fw-bold">Total Served</div>
                            <div class="display-1 text-center fw-bold">13</div>
                        </div>
                    </div>


                </div>
                <div class="col-6">


                    <div class="card shadow-sm" style="border-radius: 15px; ">
                        <div class="card-body">
                            <div class="h4 fw-bold">Pending Clients</div>
                            <div class="display-1 text-center fw-bold">5</div>
                        </div>
                    </div>


                </div>

            </div>

 -->





            </div>

            <!-- <div class="myvh bg-light border p-3 d-flex flex-column justify-content-end align-items-stretch" style="width: 30vw;">


            <div class="card p-3 align-items-center text-center bg-primary mb-3">
                <div class="h1 text-white mb-0">NEXT</div>
            </div>
            <div class="card p-3 align-items-center text-center bg-primary mb-3">
                <div class="h1 text-white mb-0">RECALL</div>
            </div>
            <div class="card p-3 align-items-center text-center bg-primary mb-3">
                <div class="h1 text-white mb-0">TRANSFER</div>
                <div class="h5 text-white">(Cashier)</div>
            </div>
            <div class="card p-3 align-items-center text-center bg-primary mb-3">
                <div class="h1 text-white mb-0">VOID</div>
            </div>
        </div> -->

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
                    document.getElementById('txt').innerHTML = h + ":" + m + " " + e;
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