<?php

namespace Tests\Vacation;

use Ottonova\Vacation\AdditionalDayRule;
use Ottonova\ValueObject\Date\Birthday;
use Ottonova\ValueObject\Date\RequestedAt;
use Ottonova\ValueObject\Date\StartedAt;
use PHPUnit\Framework\TestCase;

class AdditionalDayRuleTest extends TestCase
{
    public function provideScenario()
    {
        return [
            'plus 1 day if age >= 30 and worked > 5 years and < 10 years' => [
                new Birthday(1900, 1, 1),
                new StartedAt(1928, 1, 1),
                new RequestedAt(1933, 1, 1),
                1
            ],
            'plus 2 days if age >= 30 and worked > 10 years and < 15 yearss' => [
                new Birthday(1900, 1, 1),
                new StartedAt(1928, 1, 1),
                new RequestedAt(1938, 1, 1),
                2
            ],
            '0 day if age < 30' => [
                new Birthday(1902, 1, 1),
                new StartedAt(1928, 1, 1),
                new RequestedAt(1931, 1, 1),
                0
            ],
            '0 day if age > 30 and worked > 5 years' => [
                new Birthday(1902, 1, 1),
                new StartedAt(1928, 1, 1),
                new RequestedAt(1929, 1, 1),
                0
            ]
        ];
    }

    /**
     * @dataProvider provideScenario
     */
    public function testShouldReturnCorrectDays(
        Birthday $birthday,
        StartedAt $startedAt,
        RequestedAt $requestedAt,
        int $expected
    ) {
        $additionalDay = (new AdditionalDayRule($birthday, $startedAt))($requestedAt);

        $this->assertEquals($expected, $additionalDay);
    }
}