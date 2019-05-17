<?php

namespace Tests\Vacation;

use Ottonova\Vacation\CurrentVacation;
use Ottonova\ValueObject\Date\RequestedAt;
use Ottonova\ValueObject\Date\StartedAt;
use Ottonova\ValueObject\VacationDays;
use PHPUnit\Framework\TestCase;

class CurrentVacationTest extends TestCase
{
    public function provideScenario()
    {
        return [
            '< 1 year = 0' => [
                new StartedAt(1928, 12, 15),
                new RequestedAt(1929, 12 , 14),
                new VacationDays(26),
                0
            ],
            '1 year = Vacation Days * 1' => [
                new StartedAt(1928, 12, 15),
                new RequestedAt(1929, 12 , 15),
                new VacationDays(26),
                26
            ],
            '2 years = Vacation Days * 2' => [
                new StartedAt(1928, 12, 15),
                new RequestedAt(1930, 12 , 15),
                new VacationDays(26),
                52
            ]
        ];
    }

    /**
     * @dataProvider provideScenario
     */
    public function testShouldReturnCorrectDays(
        StartedAt $startedAt,
        RequestedAt $requestedAt,
        VacationDays $vacationDays,
        int $expected
    ) {
        $currentVacation = (new CurrentVacation($startedAt, $vacationDays))($requestedAt);

        $this->assertEquals($expected, $currentVacation);
    }
}