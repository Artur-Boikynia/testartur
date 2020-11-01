<?php
require_once __DIR__ .'/security.php';
require_once __DIR__ .'/userCount.php';
$config = require __DIR__.'/config.php';
$rout = ltrim($_GET['rout'] ?? '' , '/');
$dir = rtrim($config['baseDir'],'/');
$webRout = rtrim($config['webRout'],'/');
$actualRout = $dir;
$nameOfUser = $_SESSION['user'];

if($rout){
    $actualRout= realpath($dir . '/' . $rout);
}

$actualDir = $actualRout;
$insideRout = ltrim(str_replace($dir,'', $actualRout),'/');

if (mb_strlen($actualDir) < mb_strlen($dir)) {
    exit('Directory is not available');
}

$content='';

if(is_file($actualRout)){
    switch (mime_content_type($actualRout)){
        case 'image/jpeg':
            $content = "<img src='{$webRout}/{$rout}' alt='image' width='100%' >";
            break;
        case 'text/plain':
            $content = nl2br(file_get_contents($actualRout));
            break;
        case 'video/quicktime':
            $content = <<< VIDEO
            <video width="800" height="500" controls="controls" >
            <source src="{$webRout}/{$rout}" type='video/ogg; codecs="theora, vorbis"'>
            VIDEO;
            break;
        default:
            $content = "File can not be opened";
    }
    $actualDir = dirname($actualRout);
    $insideRout = dirname($insideRout);
}
$data = scandir($actualDir);


if($actualDir === $dir){
    $data = array_filter($data, static function (string $element){
        return !in_array($element, ['.', '..']);
    });
}
$data = array_filter($data, static function (string $element){
    return !in_array($element, ['.']);
});


uasort($data, static function($a, $b){
    global $actualDir;
    if(is_dir($actualDir . '/' . $a) === true && is_dir($actualDir . '/' . $b) === false){
        return -1;
    }
    elseif (is_dir($actualDir . '/' . $a) === true && is_dir($actualDir . '/' . $b) === true){
        return 0;
    }
    else{
        return 1;
    }
});

$nameOfDir = explode('/', $actualDir);
$nameOfDir = (end($nameOfDir));

$explodedBreadcrumbs = explode('/', $insideRout);
$lib = '';

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/Header-Nightsky.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <title>Directory</title>
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
    <a class="navbar-brand" href="index.php">MyCloud</a>
    <h1 class="navbar-brand" href="index.php"> YOUR LOGIN: <?=$nameOfUser?></h1>
    <div class="form-inline my-2 my-lg-0">
        <form style="margin-right: 10px; " action="signOut.php" class="form-inline my-2 my-lg-0" method="post">
            <button name="logout" value="out" class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button>
        </form>
        <form action="statisticPage.php" class="form-inline my-2 my-lg-0" method="post">
            <button name="statistic" value="statistic" class="btn btn-outline-success my-2 my-sm-0" type="submit">Site statistics</button>
        </form>
    </div>
</nav>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <svg style="color: black;" width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-house-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
        </svg>
        <a style="color: black" class="directions" href="?rout=">Home page</a>
    </li>
    <?php  for($key = 0; $key < count($explodedBreadcrumbs); $key++):
    $lib .= $explodedBreadcrumbs[$key] . '/';
    $r = trim($lib,'/'); ?>
    <li class="nav-item">
        <svg  style="margin-left: 10px;" width="2em"  height="2em" viewBox="0 0 16 16" class="bi bi-folder2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5v-9zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5V7z"/>
        </svg>
        <a style="color: black" class="directions" href="?rout=<?=$r?>"><?=$explodedBreadcrumbs[$key]?></a>
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
        </svg>
    </li>
    <?php endfor;?>
</ul>

<nav class="navbar navbar-dark bg-dark">
    <div>
        <svg style="color: white;" width="2em"  height="2em" viewBox="0 0 16 16" class="bi bi-folder2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5v-9zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5V7z"/>
            <h4 style="color: white"><?=$nameOfDir ?> :</h4>
        </svg>
    </div>
    <?php foreach ($data as $value) : ?>
        <?php if($value === '..') :?>
            <div>
                <svg style="color: white;" width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
                </svg>
                <a class="directions" href="?rout=<?=$insideRout?>/<?=$value?>">To last folder</a>
            </div>
        <?php elseif(is_dir($actualDir . '/' . $value)) :?>
            <div>
                <svg style="color: white;" width="2em"  height="2em" viewBox="0 0 16 16" class="bi bi-folder2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5v-9zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5V7z"/>
                </svg>
                <a class="directions" href="?rout=<?=$insideRout?>/<?=$value?>"><?=$value?></a>
            </div>
        <?php elseif(mime_content_type($actualDir . '/' . $value) == 'image/jpeg') :?>
            <div>
                <svg style="color: white;" width="2.0625em" height="2em" viewBox="0 0 17 16" class="bi bi-image-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094L15.002 9.5V13a1 1 0 0 1-1 1h-12a1 1 0 0 1-1-1v-1zm5-6.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                </svg>
                <a class="directions" href="?rout=<?=$insideRout?>/<?=$value?>"><?=$value?></a>
            </div>
        <?php elseif(mime_content_type($actualDir . '/' . $value) == 'video/quicktime') :?>
            <div>
                <svg style="color: white;" width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-file-play-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM6 5.883v4.234a.5.5 0 0 0 .757.429l3.528-2.117a.5.5 0 0 0 0-.858L6.757 5.454a.5.5 0 0 0-.757.43z"/>
                </svg>
                <a class="directions" href="?rout=<?=$insideRout?>/<?=$value?>"><?=$value?></a>
            </div>
        <?php else:?>
            <div>
                <svg style="color: white;" width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                    <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                </svg>
                <a class="directions" href="?rout=<?=$insideRout?>/<?=$value?>"><?=$value?></a>
            </div>
        <?php endif;?>
    <?php endforeach;?>
    <form action="create.php" class="form-inline my-2 my-lg-0" method="post">
        <input type="hidden" name="baseDir" value="<?=$insideRout?>">
        <input class="form-control mr-sm-2" name="newDirectory" type="text" placeholder="Name of new direction" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add direction</button>
    </form>
</nav>
<nav class="navbar navbar-dark bg-dark">
    <form  action="upload.php" class="form-inline my-2 my-lg-0" method="post" enctype="multipart/form-data">
        <input type="hidden" name="baseDir" value="<?=$insideRout?>">
        <input class="form-control mr-sm-2" name="attachment[]" type="file" placeholder="Name of file" multiple="multiple" max="2">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add files</button>
    </form>
</nav>
<div id="table">
    <div id="div2"><?=$content?></div>
</div>

</body>
</html>



