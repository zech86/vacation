<?php

namespace Ottonova\ValueObject\Date;

abstract class BaseDate
{
    /** @var \DateTimeImmutable */
    protected $date;

    protected function createDate(int $year, int $month, int $day): \DateTimeImmutable
    {
        $date = new \DateTimeImmutable();
        $date = $date->setDate($year, $month, $day);
        $date = $date->setTime(0, 0, 0, 0);

        return $date;
    }

    public function __invoke(): \DateTimeImmutable
    {
        return $this->date;
    }
}