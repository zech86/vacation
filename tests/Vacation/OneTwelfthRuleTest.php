<?php

namespace Tests\Vacation;

use Ottonova\Vacation\AdditionalDayRule;
use Ottonova\Vacation\OneTwelfthRule;
use Ottonova\ValueObject\Date\Birthday;
use Ottonova\ValueObject\Date\RequestedAt;
use Ottonova\ValueObject\Date\StartedAt;
use Ottonova\ValueObject\VacationDays;
use PHPUnit\Framework\TestCase;

class OneTwelfthRuleTest extends TestCase
{
    public function provideScenario()
    {
        return [
            'minimum 1 month and < 1 year, 1/12 vacation day' => [
                new StartedAt(1928, 12, 15),
                new RequestedAt(1929, 1 , 1),
                new VacationDays(26),
                2
            ],
            'minimum 1 month and < 1 year, 1/12 vacation day in a leap year' => [
                new StartedAt(1976, 2, 15),
                new RequestedAt(1976, 3 , 1),
                new VacationDays(26),
                2
            ],
            '0 if rule minimum 1 month and < 1 year is false' => [
                new StartedAt(1928, 12, 15),
                new RequestedAt(1928, 12 , 31),
                new VacationDays(26),
                0
            ],
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
        $additionalDay = (new OneTwelfthRule($startedAt, $vacationDays))($requestedAt);

        $this->assertEquals($expected, $additionalDay);
    }
}