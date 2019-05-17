<?php

namespace Ottonova\ValueObject\Date;

final class StartedAt extends PastDate
{
    private const CAN_START_AT = [1, 15];

    public function __construct(int $year, int $month, int $day)
    {
        $startedAt = $this->createDate($year, $month, $day);

        if (!in_array($startedAt->format('d'), self::CAN_START_AT)) {
            $message = 'An employee can start only at %s.';
            $message = sprintf($message, implode(', ', self::CAN_START_AT));

            throw new \InvalidArgumentException($message);
        }

        $this->date = $startedAt;
    }
}