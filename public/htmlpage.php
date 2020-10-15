<?php

include('taskmanager.php');

$tab = '';
$tab1 = '';
/**
 * @var  $taskManager / from another file "taskmanager.php"
 */
foreach ($taskManager as $key => $value) {
    if (is_array($value)) {
        foreach ($value as $k => $v) {
            if (is_array($v)) {
                $tab .= "<pre><pre class='font v'>$k</preid></pre>";
                foreach ($v as $k1 => $v1) {
                    if (is_array($v1)) {
                        $tab .= "<pre><pre class='font v1'> $k1</preid></pre>";
                        foreach ($v1 as $k2 => $v2) {
                            if (is_array($v2)) {
                                $tab .= "<pre><pre class='font v1'> $k2</preid></pre>";
                                foreach ($v2 as $k3 => $v3) {
                                    $tab .= "<pre class='font v3'> $k3 : $v3</pre>";
                                }
                            } else {
                                $tab .= "<pre><pre class='font v3'> $k2 : $v2</preid></pre>";
                            }
                        }
                    } else {
                        $tab .= "<pre class='font v11'> $k1 : $v1</pre>";
                    }
                }
            } else {
                $tab .= "<li><pre class='font'>$k : $v</pre></li>";
            }
        }
    } else {
        $tab .= "<pre>$key : $value</pre>";
    }
}


function nameOfFile()
{
    $fileName = __FILE__;
    $fileName = explode("/", $fileName);
    $numberOfLast = count($fileName) - 1;
    return $fileName[$numberOfLast];
}

/*function nameOfDir()
{
    $fileName = __DIR__;
    $fileName = explode("/", $fileName);
    $numberOfLast = count($fileName) - 1;
    if ($fileName[$numberOfLast] === 'www') {
        return null;
    } else return $fileName[$numberOfLast];
}*/

$fileNow = nameOfFile();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <title>taskManager</title>
</head>
<header>
    <h3><a id="textTask" href="<?= $fileNow ?>">taskManager</a></h3>
</header>
<body id="body">
<ul>
    <?= $tab ?>
</ul>

</body>

</html>