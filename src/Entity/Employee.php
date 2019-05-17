<?php

namespace Ottonova\Entity;

use Ottonova\ValueObject\Date\Birthday;
use Ottonova\ValueObject\Date\StartedAt;
use Ottonova\ValueObject\VacationDays;

class Employee
{
    /** @var string */
    private $name;

    /** @var Birthday */
    private $birthday;

    /** @var StartedAt */
    private $startedAt;

    /** @var int */
    private $vacationDays = 26;

    public function __construct(
        string $name,
        Birthday $birthday,
        StartedAt $startedAt,
        VacationDays $vacationDays
    ) {
        $this->name = $name;
        $this->birthday = $birthday;
        $this->startedAt = $startedAt;
        $this->vacationDays = $vacationDays;
    }

    public function getBirthday(): Birthday
    {
        return $this->birthday;
    }

    public function getStartedAt(): StartedAt
    {
        return $this->startedAt;
    }

    public function getVacationDays(): VacationDays
    {
        return $this->vacationDays;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}