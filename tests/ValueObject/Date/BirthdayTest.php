<?php

namespace Tests\ValueObject\Date;

use Ottonova\ValueObject\Date\Birthday;
use PHPUnit\Framework\TestCase;

class BirthdayTest extends TestCase
{
    public function testShouldReturnValidDate()
    {
        $birthday = (new Birthday(2000, 5, 10))();

        $this->assertInstanceOf(\DateTimeImmutable::class, $birthday);
        $this->assertEquals(2000, $birthday->format('Y'));
        $this->assertEquals(5, $birthday->format('m'));
        $this->assertEquals(10, $birthday->format('d'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrownExceptionWithInvalidDate()
    {
        $year = new \DateTime();
        $year->add(new \DateInterval('P1Y'));
        $year = $year->format('Y');

        (new Birthday($year, 5, 10))();
    }
}