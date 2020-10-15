<?php
error_reporting(E_ALL);

include('taskmanager.php');
include ('myfunction.php');

$tab = '';
$tab1 = '';
/**
 * @var  $taskManager / from another file "taskmanager.php"
 */
foreach ($taskManager as $key => $value) {
    if (is_array($value)) {
        foreach ($value as $k => $v) {
            if (is_array($v)) {
                $tab .= '<pre class="font v">'. '       ' . $k . '</pre>';
                foreach ($v as $k1 => $v1) {
                    if (is_array($v1)) {
                        $tab .= '<pre class="font v1">'. '  '. $k1 . '</pre>';
                        foreach ($v1 as $k2 => $v2) {
                            if (is_array($v2)) {
                                $tab .= '<pre><pre class="font v1">' . '        ' . $k2 . '</pre>';
                                foreach ($v2 as $k3 => $v3) {
                                    $tab .= '<pre class="font">'. '          '. $k3 .':'. $v3.'</pre>';
                                }
                            } else {
                                $tab .= '<pre class="font v3">' . '      ' . $k2 . ':' . $v2 . '</pre>';
                            }
                        }
                    } else {
                        $tab .= '<pre class="font v11">'. '           ' . $k1 . ':' . $v1 . '</pre>';
                    }
                }
            } else {
                $tab .= '<pre class="font">' . ' '.$k . ':' . $v .'</pre>';
            }
        }
    } else {
        $tab .= '<pre>'. '   ' .$key . ':' . $value . '</pre>';
    }
}

$fileNow = nameOfFile(__FILE__);

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