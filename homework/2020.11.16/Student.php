<?php


class Student
{
    private string $nameOfStudent = 'default';
    private string $group = 'default';
    private string $statusOfTask = 'not done';

    /**
     * @param string $name
     * @param string $group
     * @param string $status0ftask
     * @return string[]
     */
    public function setNameAndGroupOfStudent(string $name, string $group ): void{

         $this->setNameOfStudent($name);
         $this->setGroup($group);
         $this->setGroup($group);

    }

    /**
     * @param string $newStatus
     */
    public function updateStatusOfTask (string $newStatus, string $studentName):void{
        $this->setStatusOfTask($newStatus);
    }

    /**
     * @return string
     */
    protected function getNameOfStudent(): string
    {
        return $this->nameOfStudent;
    }

    /**
     * @param string $nameOfStudent
     */
    private function setNameOfStudent(string $nameOfStudent): void
    {
        $this->nameOfStudent = $nameOfStudent;
    }

    /**
     * @param string $group
     */
    private function setGroup(string $group): void
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    protected function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @param string $statusOfTask
     */
    private function setStatusOfTask(string $statusOfTask): void
    {
        $this->statusOfTask = $statusOfTask;
    }

    /**
     * @return string
     */
    protected function getStatusOfTask(): string
    {
        return $this->statusOfTask;
    }

}