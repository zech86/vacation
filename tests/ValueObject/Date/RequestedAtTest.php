<?php

namespace Tests\ValueObject\Date;

use Ottonova\ValueObject\Date\RequestedAt;
use PHPUnit\Framework\TestCase;

class RequestedAtTest extends TestCase
{
    public function provideValidRequestedAtDate()
    {
        $past = new \DateInterval('P1Y');
        $past->invert = true;

        return [
            'past' => [(new \DateTime())->add($past)],
            'future' => [(new \DateTime())->add(new \DateInterval('P1Y'))],
            'today' => [new \DateTime()],
        ];
    }

    /**
     * @dataProvider provideValidRequestedAtDate
     */
    public function testShouldReturnValidDate(\DateTime $requested)
    {
        $year = $requested->format('Y');
        $month = $requested->format('m');
        $day = $requested->format('d');

        $requested = new RequestedAt($year, $month, $day);
        $requested = $requested();

        $this->assertInstanceOf(\DateTimeImmutable::class, $requested);
        $this->assertEquals($year, $requested->format('Y'));
        $this->assertEquals($month, $requested->format('m'));
        $this->assertEquals($day, $requested->format('d'));
    }
}