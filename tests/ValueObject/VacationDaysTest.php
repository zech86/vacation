<?php

namespace Tests\ValueObject;

use Ottonova\ValueObject\VacationDays;
use PHPUnit\Framework\TestCase;

class VacationDaysTest extends TestCase
{
    public function testShouldCreateCorrectNumber()
    {
        $vacationDays = new VacationDays(100);

        $this->assertEquals(100, $vacationDays());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShouldReturnMinimum()
    {
        new VacationDays(0);
    }
}