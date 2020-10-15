<?php
/** Get name of file
 var $fileName = __FILE__ in yor script*/
function nameOfFile($fileName)
{
    $fileName = explode("/", $fileName);
    $numberOfLast = count($fileName) - 1;
    return $fileName[$numberOfLast];
}