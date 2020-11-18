<?php


class Homework extends Mentor
{
    private string $taskName = 'default';
    private string $taskBegin = 'none';
    private string $deadLine = 'none';

    /**
     * @param string $taskName
     * @param string $studentName
     * @param int $daysDuration
     */
    public function  homeworkSet (string $taskName, string $studentName, int $daysDuration ):void{

        $nowDate = time();
        $this->setTaskBegin(date('Y-m-d H:i:s',$nowDate));
        $this->setTaskName($taskName);
        $this->setDeadLine(date('Y-m-d H:i:s',$nowDate + $daysDuration * 24 * 3600));
    }

    /**
     * @param string $studentName
     */
    public function monitoringOfProcess(string $studentName): void{
        $taskStatus = $this->getStatusOfTask() ;
        $checkStatus = $this->getStatusOfChek();

        if($taskStatus === 'done' && $checkStatus === 'No checked'){
            $text =  "Mentor {$this->getNameOfMentor()}  can begin to check task \"{$this->getTaskName()}\" ";
            echo $text;
            }
        elseif ($checkStatus === 'processing' && $taskStatus === 'done'){
            $text =  " Task \"{$this->getTaskName()}\" is in PROCESSING <br/><br/>";
            echo $text;
            $this->printData($studentName);
        }
        elseif ($checkStatus === 'checked' &&  $taskStatus == 'done'){
            $text = " {$this->getNameOfStudent()}, your task \"{$this->getTaskName()}\" is already checked, you can finde yor point in Campus ";
            echo $text ;
        }
        else{
            $text = "Student {$this->getNameOfStudent()} has not yet done  task \"{$this->getTaskName()}\" <br/><br/> ";
            echo $text ;
            $this->printData($studentName);
        }
    }

    /**
     * @param string $studentName
     */
    private function printData (string $studentName){
//        $text =  " Task \"{$this->getTaskName()}\" is in PROCESSING <br/>";
        $text1 =  "Data for Home : <br/>";
        $text2 =  "Student : {$this->getNameOfStudent()} <br/>";
        $text3 =  "Group : {$this->getGroup()} <br/>";
        $text4 =  "Status of task  : {$this->getStatusOfTask()} <br/>";
        $text5 =  "Mentor  : {$this->getTitle()} {$this->memory[$studentName]['nameofmentor']} <br/>";
        $text6 =  "Status of check  : {$this->getStatusOfChek()} <br/>";
        $text7 =  "Task  : {$this->getTaskName()} <br/>";
        $text8 =  "Start  : {$this->getTaskBegin()} <br/>";
        $text9 =  "Deadline  : {$this->getDeadLine()} <br/>" ;

        echo  $text1 . $text2. $text3 . $text4 . $text5 . $text6 . $text7 . $text8 . $text9;
    }

    /**
     * @param string $deadLine
     */
    private function setDeadLine(string $deadLine): void
    {
        $this->deadLine = $deadLine;
    }

    /**
     * @return int
     */
    private function getDeadLine(): string
    {
        return $this->deadLine;
    }

    /**
     * @param int $taskBegin
     */
    private function setTaskBegin(string $taskBegin): void
    {
        $this->taskBegin = $taskBegin;
    }

    /**
     * @return int
     */
    private function getTaskBegin(): string
    {
        return $this->taskBegin;
    }

    /**
     * @param string $taskName
     */
    private function setTaskName(string $taskName): void
    {
        $this->taskName = $taskName;
    }

    /**
     * @return string
     */
    private function getTaskName(): string
    {
        return $this->taskName;
    }

}