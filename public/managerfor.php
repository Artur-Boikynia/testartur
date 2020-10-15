<?php
include ('taskmanager.php');
include ('myfunction.php');
$tab = '';
/** @var  $taskManager */

for ($key = 0; $key < count($taskManager); $key++){
    if(is_array($taskManager[$key])){
        $tab .= "<pre><pre class='font key'>$key</pre></pre>";
        for (reset($taskManager[$key]); $k = key($taskManager[$key]); next($taskManager[$key])){
            if(is_array($taskManager[$key][$k])){
                $tab .= '<pre class="font sub">'. '   ' .$k . '</pre>';
                if(is_string(key($taskManager[$key][$k]))){
                    for (reset($taskManager[$key][$k]); $k1 = key($taskManager[$key][$k]); next($taskManager[$key][$k])){
                        $tab .= '<pre class="font owner">' .  '        ' . $k1 . ':' .$taskManager[$key][$k][$k1]. '</pre>';
                    }}
                    else{
                        for ($k11 = 0; $k11 < count($taskManager[$key][$k]); $k11++){
                            if(is_array($taskManager[$key][$k][$k11])){
                                $tab .= '<pre class="font v11">'.'   '.$k11 . '</pre>';
                                for (reset($taskManager[$key][$k][$k11]); $k2 = key($taskManager[$key][$k][$k11]);next($taskManager[$key][$k][$k11])){
                                    if(is_array($taskManager[$key][$k][$k11][$k2])){
                                        $tab .= '<pre><pre class="font v11">' . '    ' . $k2 . '</pre></pre>';
                                        for (reset($taskManager[$key][$k][$k11][$k2]); $k3 = key($taskManager[$key][$k][$k11][$k2]);next($taskManager[$key][$k][$k11][$k2])){
                                            $tab .= '<pre class="font tab1">' . '      ' . $k3 . ':' . $taskManager[$key][$k][$k11][$k2][$k3] . '</pre>';
                                        }
                                    }
                                    else{
                                        $tab .= '<pre class="font">' . '     ' . $k2 . ':' . $taskManager[$key][$k][$k11][$k2] . '</pre>';
                                    }
                                }
                            }
                            else{
                                $tab .= '<pre class="font">'. $k11. ':' . $taskManager[$key][$k][$k11] . '</pre>';
                            }
                        }
                    }

                }
           else{
               $tab .= '<pre class="font">' . '  '. $k . ':' . $taskManager[$key][$k] . '</pre>';
           }

        }}
    else{
        $tab .= '<pre class="font">' . $key . ':' . $taskManager[$key] . '</pre>';
    }
}

$files = nameOfFile(__FILE__);
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
    <h3><a id="textTask" href="<?= $files ?>">taskManager</a></h3>
</header>
<body id="body">
<ul>
    <?= $tab ?>
</ul>

</body>

</html>
