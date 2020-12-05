<?php
namespace homework;

/**
 * Class Homework
 * @package homework
 */
class Homework
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
     * @var bool
     */
    private bool $mentorStatus = false;

    /**
     * Homework constructor.
     * @param $nameOfMentor
     * @param $nameOfStudent
     */
    public function __construct($nameOfMentor, $nameOfStudent){
        $this->nameOfMentor = $nameOfMentor;
        $this->nameOfStudent = $nameOfStudent;
    }

    /**
     * @param bool $studentStatus
     */
    public function setStudentStatus(bool $studentStatus): void
    {
        $this->studentStatus = $studentStatus;
    }

    /**
     * @param bool $mentorStatus
     */
    public function setMentorStatus(bool $mentorStatus): void
    {
        $this->mentorStatus = $mentorStatus;
    }

    /**
     * @return bool
     */
    public function isStudentStatus(): bool
    {
        return $this->studentStatus;
    }

    /**
     * @return bool
     */
    public function isMentorStatus(): bool
    {
        return $this->mentorStatus;
    }

}