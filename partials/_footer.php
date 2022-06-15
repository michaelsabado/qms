<script src="../partials/bootstrap.bundle.min.js"></script>
<script src="../partials/jquery.min.js"></script>

<script src="../partials/dataTables.min.js"></script>
<script src="../partials/dataTables.bootstrap5.min.js"></script>



<script src="../partials/sweetalert.js"></script>
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
            if (h == 0) {
                h = 12;
            }
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