<?php

namespace Ottonova\Vacation;

use Ottonova\ValueObject\Date\RequestedAt;
use Ottonova\ValueObject\Date\StartedAt;
use Ottonova\ValueObject\VacationDays;

class CurrentVacation
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

    /**
     * @todo: Check if user already used last vacations
     *
     * @param RequestedAt $requested
     * @return int
     */
    public function __invoke(RequestedAt $requested, bool $full = true): int
    {
        $requested = $requested();

        if ($requested < $this->startedAt) {
            return 0;
        }

        $diff = $this->startedAt->diff($requested);
        $workingYears = $diff->y;

        if ($workingYears < 1) {
            return 0;
        }

        if ($full === false) {
            return $this->vacationsDays;
        }

        $workingYears = $diff->days / 365;

        return round($workingYears * $this->vacationsDays);
    }
}