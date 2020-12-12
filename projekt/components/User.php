<?php


namespace app\components;


class User
{
    private bool $isGuest = true;

    private bool $isTeacher = false;

    private bool $isStudent = false;

    public function isGuest(): bool
    {
        return $this->isGuest;
    }

    /**
     * @return bool
     */
    public function isTeacher(): bool
    {
        return $this->isTeacher;
    }

    /**
     * @return bool
     */
    public function isStudent(): bool
    {
        return $this->isStudent;
    }

}