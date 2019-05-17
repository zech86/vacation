<?php

namespace Ottonova\Vacation;

use Ottonova\ValueObject\Date\Birthday;
use Ottonova\ValueObject\Date\RequestedAt;
use Ottonova\ValueObject\Date\StartedAt;

class AdditionalDayRule
{
    private const ADDITIONAL_DAY_EVERY_YEAR = 5;
    private const MINIMUM_AGE_TO_GET_EXTRA_DAYS = 30;

    /** @var \DateTimeImmutable */
    private $birthday;

    /** @var \DateTimeImmutable */
    private $startedAt;

    public function __construct(Birthday $birthday, StartedAt $startedAt)
    {
        $this->birthday = $birthday();
        $this->startedAt = $startedAt();
    }

    public function __invoke(RequestedAt $requested): int
    {
        $requested = $requested();

        if ($requested < $this->startedAt) {
            return 0;
        }

        $age = $this->birthday->diff($requested)->y;

        if ($age < self::MINIMUM_AGE_TO_GET_EXTRA_DAYS) {
            return 0;
        }

        $workingYears = $this->startedAt->diff($requested)->y;

        if ($workingYears < self::ADDITIONAL_DAY_EVERY_YEAR) {
            return 0;
        }

        $additional = round($workingYears / self::ADDITIONAL_DAY_EVERY_YEAR);

        return $additional;
    }
}