<?php
class Student
{
    final public function getId(): string
    {
        return '2026001';
    }
}

class RegularStudent extends Student
{
    public function getId(): string
    {
        return '2026002';
    }
}

