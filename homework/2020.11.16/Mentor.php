<?php


class Mentor extends Student
{
    private string $nameOfMentor = 'default';
    private $title = 'default';
    private $statusOfChek = 'No checked';

    /**
     * @param string $name
     * @param string $title
     * @param string $statusOfCheck
     * @return string[]
     */
    public function setNameAndTitleOfMentor(string $name, string $title, string $studentName): void{

        $this->setNameOfMentor($name);
        $this->setTitle($title);
        $this->setStatusOfchek($this->statusOfChek);

    }

    public function updateStatusOfCheck(string $newStatus, string $studentName):void{
        $this->setStatusOfChek($newStatus);
    }

    /**
     * @param string $title
     */
    private function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    protected function getTitle(): string
    {
        return $this->title;
    }


    /**
     * @param string $nameOfMentor
     */
    private function setNameOfMentor(string $nameOfMentor): void
    {
        $this->nameOfMentor = $nameOfMentor;
    }


    /**
     * @return string
     */
    protected function getNameOfMentor(): string
    {
        return $this->nameOfMentor;
    }

    /**
     * @return string
     */
    protected function getStatusOfChek(): string
    {
        return $this->statusOfChek;
    }

    /**
     * @param string $statusOfChek
     */
    private function setStatusOfChek(string $statusOfChek): void
    {
        $this->statusOfChek = $statusOfChek;
    }


}