<?php

namespace Tests\Vacation;

use Ottonova\Entity\Employee;
use Ottonova\Vacation\Calculate;
use Ottonova\ValueObject\Date\Birthday;
use Ottonova\ValueObject\Date\RequestedAt;
use Ottonova\ValueObject\Date\StartedAt;
use Ottonova\ValueObject\VacationDays;
use PHPUnit\Framework\TestCase;

class CalculateTest extends TestCase
{
    public function testShouldReturnCorrectDays()
    {
        $employee = new Employee(
            'test',
            new Birthday(1900, 1, 1),
            new StartedAt(1928, 1, 15),
            new VacationDays(100)
        );

        $requestedAt = new RequestedAt(1930, 1, 15);

        $calulated = new Calculate();
        $calulated = $calulated($employee, $requestedAt);

        $this->assertEquals(200, $calulated);
    }
}