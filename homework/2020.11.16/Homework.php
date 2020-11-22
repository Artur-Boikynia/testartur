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
        $this->memory[$studentName]['taskName'] = $this->getTaskName();
        $this->memory[$studentName]['taskBegin'] = $this->getTaskBegin();
        $this->memory[$studentName]['deadline'] = $this->getDeadLine();
    }

    /**
     * @param string $studentName
     */
    public function monitoringOfProcess(string $studentName): void{
        $taskStatus = $this->memory[$studentName]['statusoftask'] ;
        $checkStatus = $this->memory[$studentName]['statusofcheck'] ;

        if($taskStatus === 'done' && $checkStatus === 'No checked'){
            $text =  "Mentor {$this->memory[$studentName]['nameofmentor']}  can begin to check task \"{$this->memory[$studentName]['taskName']}\" ";
            echo $text;
            }
        elseif ($checkStatus === 'processing' && $taskStatus === 'done'){
             $text =  " Task \"{$this->memory[$studentName]['taskName']}\" is in PROCESSING <br/>";
             echo $text;
             $this->printData($studentName);
        }
        elseif ($checkStatus === 'checked' &&  $taskStatus == 'done'){
            $text = " {$this->memory[$studentName]['nameofstudent']}, your task \"{$this->memory[$studentName]['taskName']}\" is already checked, you can find result in Campus ";
            echo $text ;
        }
        else{
            $text = "Student {$this->memory[$studentName]['nameofstudent']} has not yet done  task \"{$this->memory[$studentName]['taskName']}\" <br/><br/> ";
            echo $text ;
            $this->printData($studentName);
        }
    }

    /**
     * @param string $studentName
     */
    private function printData (string $studentName){

        $text1 =  "Data for Home : <br/>";
        $text2 =  "Student : {$this->memory[$studentName]['nameofstudent']} <br/>";
        $text3 =  "Group : {$this->memory[$studentName]['group']} <br/>";
        $text4 =  "Status of task  : {$this->memory[$studentName]['statusoftask']} <br/>";
        $text5 =  "Mentor  : {$this->memory[$studentName]['title']} {$this->memory[$studentName]['nameofmentor']} <br/>";
        $text6 =  "Status of check  : {$this->memory[$studentName]['statusofcheck']} <br/>";
        $text7 =  "Task  : {$this->memory[$studentName]['taskName']} <br/>";
        $text8 =  "Start  : {$this->memory[$studentName]['taskBegin']} <br/>";
        $text9 =  "Deadline  : {$this->memory[$studentName]['deadline']} <br/>" ;

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