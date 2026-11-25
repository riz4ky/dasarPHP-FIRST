<?php

declare(strict_types=1);

require_once 'Student.php';

class InternationalStudent extends Student
{
    public function calculateFee(): float
    {
        // Biaya mahasiswa internasional
        // mendapatkan tambahan 50%
        return $this->baseFee * 1.5;
    }

    public function summary(): string
    {
        return parent::summary()
            . ' [International Student]';
    }
}