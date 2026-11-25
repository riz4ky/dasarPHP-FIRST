<?php
declare(strict_types=1);
require_once __DIR__ . '/Student.php';

final class ExchangeStudent extends Student
{
    public function __construct(
        string $studentId,
        string $name,
        string $major,
        int $semester,
        private float $tuition,
        private string $partnerUniversity = 'International Partner University'
    ) {
        self::validateTuition($tuition);
        $this->partnerUniversity = trim($partnerUniversity);
        if ($this->partnerUniversity === '') {
            throw new InvalidArgumentException('Partner university name is required.');
        }
        parent::__construct($studentId, $name, $major, $semester);
    }

    private static function validateTuition(float $amount): void
    {
        if (!is_finite($amount) || $amount < 0) {
            throw new InvalidArgumentException('Tuition must be a non-negative finite number.');
        }
    }

    public function updateTuition(float $tuition): void
    {
        self::validateTuition($tuition);
        $this->tuition = $tuition;
    }

    public function getPartnerUniversity(): string
    {
        return $this->partnerUniversity;
    }

    public function updatePartnerUniversity(string $partnerUniversity): void
    {
        $trimmed = trim($partnerUniversity);
        if ($trimmed === '') {
            throw new InvalidArgumentException('Partner university name is required.');
        }
        $this->partnerUniversity = $trimmed;
    }

    public function getType(): string
    {
        return 'Exchange';
    }

    public function getBaseTuition(): float
    {
        return $this->tuition;
    }

    public function getDiscountPercent(): float
    {
        return 0.0;
    }

    public function calculateTuition(): float
    {
        return $this->tuition;
    }

    /**
     * Concrete method overriding: calls parent::getDescription()
     */
    public function getDescription(): string
    {
        return parent::getDescription() . " [Exchange: {$this->partnerUniversity}]";
    }
}
