<?php
session_start();
$loginUser = $_SESSION['user'];
require_once __DIR__ .'/security.php';
require_once __DIR__ .'/userCount.php';

/** @var  array $filtredArray  */
$arrayForTable = $filtredArray;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/Header-Nightsky.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <title>Statistic</title>
</head>
<body>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
-->

<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="statisticPage.php">MyCloud</a>
    <h1 class="navbar-brand" href="index.php"> YOUR LOGIN: <?=$loginUser ?></h1>
    <div class="form-inline my-2 my-lg-0">
        <form style="margin-right: 10px; " action="signOut.php" class="form-inline my-2 my-lg-0" method="post">
            <button name="logout" value="out" class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button>
        </form>
        <form action="index.php" class="form-inline my-2 my-lg-0" method="post">
            <button name="homePage" value="homePage" class="btn btn-outline-success my-2 my-sm-0" type="submit">Back to home page</button>
        </form>
    </div>
</nav>
<nav style="text-align: center;" class="navbar-dark bg-dark">
    <h1 class="navbar-brand" href="index.php"> Visitors for : <?=date('Y-m-d')?></h1>
</nav>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">Number of visits</th>
        <th scope="col">Date</th>
    </tr>
    </thead>
    <?php for($i = 0; $i < count($arrayForTable); $i++) : ?>
        <?php $col= $i+1;
        (int) $sumOfVisits += $arrayForTable[$i]['count'];
        ?>
    <tbody>
        <tr>
            <th scope="row"><?=$col?></th>
            <td><?= $arrayForTable[$i]['username']?></td>
            <td><?= $arrayForTable[$i]['count']?></td>
            <td><?= $arrayForTable[$i]['visit']?></td>
        </tr>
    </tbody>
    <?php endfor; ?>
</table>

<table style="width: 100%">
    <?php for($i = 0; $i < count($arrayForTable); $i++) : ?>
        <?php
        $col= $i+1;
         $percent = round((($arrayForTable[$i]['count'] / $sumOfVisits) * 100), 1);
        ?>
        <tr style="width: 100%">
            <td style="width: 10%; text-align: center"><?= $arrayForTable[$i]['username']?></td>
            <td style="width: 90%">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?=$percent?>%;" aria-valuenow="<?=$percent?>" aria-valuemin="0" aria-valuemax="100"><?=$percent?>%</div>
                </div>
            </td>
        </tr>
    <?php endfor; ?>
</table>
</body>
</html>