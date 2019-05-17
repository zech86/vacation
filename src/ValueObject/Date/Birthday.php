<?php

namespace Ottonova\ValueObject\Date;

final class Birthday extends PastDate
{
    public function __construct(int $year, int $month, int $day)
    {
        $this->date = $this->createDate($year, $month, $day);
    }
}