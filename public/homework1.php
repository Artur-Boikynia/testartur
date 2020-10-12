<?php
echo 'Exercise 1  <br>';

$x = true;    //  or $x = (bool)1
if ($x == 1) {
    echo 1;
}
if ($x == 2) {
    echo 2;
}
if ($x == 3) {
    echo 3;
}

echo '<br> Exercise 2  <br>';

$number = (int) 100;              // you must change this variable manually
echo $number === 0 ? 'Number is zero' : ($number === 1 ? 'Number is one' : ($number === 2 ? 'Number is two' : ($number % 2 === 0 ? "Number {$number} is even" : "Number {$number} is odd")));