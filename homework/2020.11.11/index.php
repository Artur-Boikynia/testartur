<?php

require_once __DIR__ .'/security.php';

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
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
    <a class="navbar-brand" href="index.php">MyShop</a>
    <h1 class="navbar-brand" href="index.php"> YOUR LOGIN: </h1>
    <div class="form-inline my-2 my-lg-0">
        <form style="margin-right: 10px; " action="/homework/2020.11.11/categories/sign-out" class="form-inline my-2 my-lg-0" method="post">
            <button name="logout" value="out" class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button>
        </form>
        <form action="statisticPage.php" class="form-inline my-2 my-lg-0" method="post">
            <button name="statistic" value="statistic" class="btn btn-outline-success my-2 my-sm-0" type="submit">Site statistics</button>
        </form>
    </div>
</nav>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/homework/2020.11.11/">Action with categories : </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="/homework/2020.11.11/categories/create">Create</a>
                <a class="nav-link" href="/homework/2020.11.11/categories/update">Update</a>
                <a class="nav-link" href="/homework/2020.11.11/categories/show-all">Show All</a>
                <a class="nav-link" href="/homework/2020.11.11/categories/show">Show One</a>
                <a class="nav-link" href="/homework/2020.11.11/categories/delete">Delete</a>
            </div>
        </div>
    </nav>




<?php

error_reporting(E_ALL);

$config = require __DIR__ . '/config.php';

require_once __DIR__ . '/lib/dispatcher.php';
require_once __DIR__ . '/lib/db.php';

setDb($config);
dispatch($_SERVER['REQUEST_URI'], $config);
?>

</body>

</html>