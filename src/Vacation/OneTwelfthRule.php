<?php

namespace Ottonova\Vacation;

use Ottonova\ValueObject\Date\RequestedAt;
use Ottonova\ValueObject\Date\StartedAt;
use Ottonova\ValueObject\VacationDays;

class OneTwelfthRule
{
    /** @var \DateTimeImmutable */
    private $startedAt;

    /** @var int */
    private $vacationsDays;

    public function __construct(StartedAt $startedAt, VacationDays $vacationDays)
    {
        $this->startedAt = $startedAt();
        $this->vacationsDays = $vacationDays();
    }

    public function __invoke(RequestedAt $requested): int
    {
        $requested = $requested();

        if ($requested < $this->startedAt) {
            return 0;
        }

        if ($requested->diff($this->startedAt)->y >= 1) {
            return 0;
        }

        $firstDayMonthAfterStart = $this->startedAt->modify('first day of +1 month');

        if ($firstDayMonthAfterStart > $requested) {
            return 0;
        }

        return round($this->vacationsDays / 12);
    }
}