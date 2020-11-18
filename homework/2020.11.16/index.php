<?php
require_once __DIR__ . '/Student.php';
require_once __DIR__ . '/Mentor.php';
require_once __DIR__ . '/Homework.php';





$task1 = new Homework();
$task1 -> setNameAndTitleOfMentor('Viktor','PhD','Artur');
$task1 -> setNameAndGroupOfStudent('Artur', 'DP-92');
$task1 -> homeworkSet("OOP", 'Artur', 2);


//$task1 -> updateStatusOfTask('done', 'Artur' );        // done, not done
//$task1 -> updateStatusOfCheck('processing', 'Artur');      //processing , checked, No checked


$task1-> monitoringOfProcess('Artur');






