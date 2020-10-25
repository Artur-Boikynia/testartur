<?php

$config = require_once __DIR__.'/config.php';
$rout = ltrim($_GET['rout'] ?? '' , '/');
$dir = rtrim($config['baseDir'],'/');
$webRout = rtrim($config['webRout'],'/');


if($rout){
    $dir .= '/'. $rout;
}

$content='';
if(is_file($dir)){
    switch (mime_content_type($dir)){
        case 'image/jpeg':
            $content = "<img src='{$webRout}/{$rout}' alt='image' width='100%'>";
            $dir = dirname($dir);
            break;
        case 'text/plain':
            $content = nl2br(file_get_contents($dir));
            $dir = dirname($dir);
            break;
        default:
            $content = "File can not be opened";
            $dir = dirname($dir);
    }
}
/*elseif (is_dir($dir)){
    if(trim($config['baseDir'],'/') === trim($dir,'/')){
        $dir = rtrim($config['baseDir'],'/');
    }
    else{
        $dir = dirname($dir);
    }
}*/
var_dump($dir);
$data = scandir($dir);


/*if(trim($config['baseDir'],'/') === trim($dir,'/')){
    $data = array_filter($data, static function(string $element){
        if ($element === '.' || $element ==='..'){
            return false;
        }
        else{
            return true;
    }
    });
}
else{
    $data = array_filter($data, static function(string $element){
        if ($element === '.'){
            return false;
        }
        else{
            return true;
        }
    });
}*/


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
    <?php foreach ($data as $value) : ?>
    <div>
        <svg style="color: white;" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
            <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
            <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
        </svg>
        <a class="directions" href="?rout=<?=$rout?>/<?=$value?>"><?=$value?></a>
    </div>
    <?php endforeach;?>
    <form action="create.php" class="form-inline my-2 my-lg-0" method="post">
        <input type="hidden" name="baseDir" value="<?=$dir?>">
        <input class="form-control mr-sm-2" name="newDirectory" type="text" placeholder="Name of new direction" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add direction</button>
    </form>
</nav>

<div id="table">
    <div id="div2"><?=$content?></div>
</div>

</body>
</html>



