<?php
class Student
{
    public function getName(): string
    {
        return 'Ahmad';
    }
}

class RegularStudent extends Student
{
    public function getName(): int
    {
        return 123;
    }
}