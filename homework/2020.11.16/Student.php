<?php


class Student
{
    protected array $memory = [];
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
         $this->memory[$name]['nameofstudent'] = $this->getNameOfStudent();
         $this->memory[$name]['group'] = $this->getGroup();
         $this->memory[$name]['statusoftask'] = $this->getStatusOfTask();
         ;
    }

    /**
     * @param string $newStatus
     */
    public function updateStatusOfTask (string $newStatus, string $studentName):void{
        $this->setStatusOfTask($newStatus);
        $this->memory[$studentName]['statusoftask'] = $this->getStatusOfTask();
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

    /**
     * @return array
     */
    protected function getMemory(): array // must be protected
    {
        return $this->memory;
    }


}