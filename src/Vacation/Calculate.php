<?php

namespace Ottonova\Vacation;

use Ottonova\Entity\Employee;
use Ottonova\ValueObject\Date\RequestedAt;

class Calculate
{
    public function __invoke(
        Employee $employee,
        RequestedAt $requestedAt,
        bool $full = true
    ): int
    {
        $additional = new AdditionalDayRule(
            $employee->getBirthday(),
            $employee->getStartedAt()
        );

        $oneTwelfth = new OneTwelfthRule(
            $employee->getStartedAt(),
            $employee->getVacationDays()
        );

        $current = new CurrentVacation(
            $employee->getStartedAt(),
            $employee->getVacationDays()
        );

        return $additional($requestedAt)
            + $oneTwelfth($requestedAt)
            + $current($requestedAt, $full);
    }
}