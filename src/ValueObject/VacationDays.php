<?php

namespace Ottonova\ValueObject;

class VacationDays
{
    private const MINIMUM_VACATION_DAYS = 26;

    /** @var int */
    protected $days;

    public function __construct(int $days)
    {
        if ($days < self::MINIMUM_VACATION_DAYS) {
            $message = 'Vacation days should be greater or equal to %s.';
            $message = sprintf($message, self::MINIMUM_VACATION_DAYS);

            throw new \InvalidArgumentException($message);
        }

        $this->days = $days;
    }

    public function __invoke(): int
    {
        return $this->days;
    }
}