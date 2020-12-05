<?php
require_once __DIR__ . '/CheckExceptions.php';
require_once __DIR__ . '/Mentor.php';
require_once __DIR__ . '/Homework.php';
require_once __DIR__ . '/Student.php';
// Mentor
$mentor = new \homework\Mentor();
$mentor->giveTask('Yakovenko', 'Boikynia');

//Student
$student = new \homework\Student($mentor);

//Action
$student->setStudentStatus(false);    // values can be  TRUE or FALSE  1) TRUE - student DONE the task 2) FALSE - student didn`t do task yet
                                            // if FALSE mentor can not check the task

$mentor->setMentorStatus(false);     // values can be TRUE or FALSE   1) TRUE - mentor CHECKED the task 2) FALSE - mentor haven`t checked the task yet


// Show Homework-Status
$mentor->showInfo();









