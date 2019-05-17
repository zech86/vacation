<?php

namespace Ottonova\ValueObject\Date;

abstract class PastDate
{
    /** @var \DateTimeImmutable */
    protected $date;

    public function __construct(int $year, int $month, int $day)
    {
        $this->date = $this->createDate($year, $month, $day);
    }

    protected function createDate(int $year, int $month, int $day): \DateTimeImmutable
    {
        $date = new \DateTimeImmutable();
        $date = $date->setDate($year, $month, $day);
        $date = $date->setTime(0, 0, 0, 0);

        $current = new \DateTime();
        $current->setTime(0, 0, 0, 0);

        if ($date > $current) {
            $message = 'Date must be smaller than %s';
            $message = sprintf($message, $current->format('Y-m-d'));

            throw new \InvalidArgumentException($message);
        }

        return $date;
    }

    public function __invoke(): \DateTimeImmutable
    {
        return $this->date;
    }
}