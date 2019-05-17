<?php

namespace Tests\ValueObject\Date;

use Ottonova\ValueObject\Date\StartedAt;
use PHPUnit\Framework\TestCase;

class StartedAtTest extends TestCase
{
    public function provideValidStartDate()
    {
        return [
            'start at 1' => [2000, 12, 1],
            'start at 15' => [2000, 12, 15],
        ];
    }

    /**
     * @dataProvider provideValidStartDate
     */
    public function testShouldReturnValidDate(int $year, int $month, int $day)
    {
        $startedAt = (new StartedAt($year, $month, $day))();

        $this->assertInstanceOf(\DateTimeImmutable::class, $startedAt);
        $this->assertEquals($year, $startedAt->format('Y'));
        $this->assertEquals($month, $startedAt->format('m'));
        $this->assertEquals($day, $startedAt->format('d'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrownExceptionWithInvalidDate()
    {
        (new StartedAt(2000, 5, 10))();
    }
}