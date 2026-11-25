<?php
class Student
{
    private function getStatus(): string
    {
        return 'Active';
    }
}

class RegularStudent extends Student
{
    public function getStatus(): string
    {
        return 'Regular Student';
    }
}