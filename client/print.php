<?php
session_start();
include '../database/dbconfig.php';


$id = $_GET['id'];

$time = date('Y-m-d h:i:s');

$result = $conn->query('SELECT * FROM queue a INNER JOIN service b ON a.serviceid = b.serviceid INNER JOIN counter c ON a.counterid = c.counterid INNER JOIN service d ON a.serviceid = d.serviceid INNER JOIN major e ON a.majorid = e.majorid INNER JOIN program f on e.programid = f.programid WHERE a.queueid = ' . $id);
$data  = $result->fetch_assoc();

$type = '';
switch ($data['category']) {
    case 1:
        $type = 'Request';
        break;
    case 2:
        $type = 'Enrollment';
        break;
    case 3:
        $type = 'Application';
        break;
    case 4:
        $type = 'Claiming';
        break;
    case 5:
        $type = 'Submission';
        break;
    case 6:
        $type = 'Query & Others';
        break;
}
function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <title>Get Queue</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: black;
            margin: 0;

        }

        .smalltxt {
            font-size: 11px;
        }

        .smalltxt1 {
            font-size: 9px;
        }
    </style>
</head>

<body>
    <div class="text-center mb-4">
        <div class="h6 text-wrap"><?= $data['identification'] ?></div>
        <div class="display-1 fw-bold"><?= $data['token'] ?></div>
        <div class="h5  fst-italic fw-bold smalltxt mb-2">Please wait in Window <?= $data['windowno'] ?></div>
        <hr>
        <div class="h6 smalltxt mb-0"><?= $data['programdescription'] ?></div>
        <div class="h6 smalltxt1 mb-2"> <?= ($data['majordescription'] != 'n/a') ? "Major in " . $data['majordescription'] : "" ?></div>
        <div class="h6 smalltxt "><?= $type . ' | ' . $data['description'] ?></div>
        <div class="smalltxt fst-italic">
            <?= $time ?>
        </div>
    </div>
    <div class="h6 text-center">* * * * *</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        window.print();

        window.onafterprint = function() {

            window.location.href = "index.php";


        }
    </script>
</body>

</html>