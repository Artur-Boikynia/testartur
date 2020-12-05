<?php
namespace homework;

use homework;
/**
 * Class Student
 * @package homework
 */
class Student
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
     * @var bool
     */
    private bool $studentStatus = false;
    /**
     * @var Mentor|null
     */
    private  ?Mentor $objektMentor = null;

    /**
     * Student constructor.
     * @param Mentor $mentor
     */
    public function __construct(Mentor $mentor){
        $this->objektMentor = $mentor;
    }

    /**
     * @param bool $bool
     */
    public function setStudentStatus (bool $bool){
        if($this->objektMentor !== null){
            $this->objektMentor->setStudentStatus($bool);
        }
    }
}