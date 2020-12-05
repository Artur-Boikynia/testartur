<?php
namespace homework;

use homework;

/**
 * Class Mentor
 * @package homework
 */
class Mentor
{
    /**
     * @var string
     */
    private string $nameOfMentor = '';
    /**
     * @var string
     */
    private string $nameOfStudent = '';
    /**
     * @var \homework\Homework|null
     */
    private ?\homework\Homework $homework = null;
    /**
     * @var Student|null
     */
    private ? Student $student = null;

    /**
     * Mentor constructor.
     */
    public function __construct(){

    }

    /**
     * @param $nameOfMentor
     * @param $nameOfStudent
     */
    public function giveTask($nameOfMentor, $nameOfStudent):void{
        $this->nameOfMentor = $nameOfMentor;
        $this->nameOfStudent = $nameOfStudent;
        $this->homework = new \homework\Homework($nameOfMentor, $nameOfStudent);
    }

    /**
     * @param bool $bool
     * @throws CheckExceptions
     */
    public function setMentorStatus( bool $bool):void{
        $studentStatus = $this->homework->isStudentStatus();

        if($this->homework === null){
            exit('Homework was not given');
        }
        if (!$studentStatus && $bool === true){
            $this->homework->setMentorStatus(false);
            throw new CheckExceptions('You can not set Mentor-Status TRUE(checked), because student NOT done the task yet');
        }

        $this->homework->setMentorStatus($bool);
    }

    /**
     * @param bool $bool
     */
    public function setStudentStatus( bool $bool){
        if($this->homework !== null){
            $this->homework->setStudentStatus($bool);
        }
        else{
            exit('Homework was not given');
        }
    }

    /**
     *
     */
    public function showInfo():void{
        $mentorStatus= $this->homework->isMentorStatus();
        $studentStatus = $this->homework->isStudentStatus();
        $mentorName = $this->nameOfMentor;
        $studentName = $this->nameOfStudent;

        if(!empty($mentorName) && !empty($studentName)){
            echo "Mentor \"{$mentorName}\" gave the task for student \"{$studentName}\" </br>";
        }
        else{
            exit('Task was not set');
        }

        if($studentStatus){
            echo "Student \"{$studentName}\" DONE the task </br>";
        }
        else{
            echo "Mentor \"{$studentName}\" didn`t do the task yet </br>";
        }


        if($mentorStatus){
            echo "Mentor \"{$mentorName}\" checked the task </br>";
        }
        else{
            echo "Mentor \"{$mentorName}\" haven`t checked the task yet </br>";
        }
    }


}