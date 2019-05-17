<?php

namespace Ottonova\ValueObject\Date;

final class RequestedAt extends BaseDate
{
    public function __construct(int $year, int $month, int $day)
    {
        $this->date = $this->createDate($year, $month, $day);
    }
}