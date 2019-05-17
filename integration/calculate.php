<?php

namespace Integration;

include __DIR__ . '/../vendor/autoload.php';

use Ottonova\Entity\Employee;
use Ottonova\Vacation\Calculate;
use Ottonova\ValueObject\Date\Birthday;
use Ottonova\ValueObject\Date\RequestedAt;
use Ottonova\ValueObject\Date\StartedAt;
use Ottonova\ValueObject\VacationDays;

$requestedAt = $argv[1] ?? (new \DateTime())->format('Y-m-d');;
$requestedAt = date_create_from_format('Y-m-d', $requestedAt);
$requestedAt = !$requestedAt ? new \DateTime() : $requestedAt;

$requestedAt = new RequestedAt(
    $requestedAt->format('Y'),
    $requestedAt->format('m'),
    $requestedAt->format('d')
);

$full = !empty($argv[2]);

$handle = fopen(__DIR__ . "/data.csv", "r");
$employees = [];

while ($data = fgetcsv($handle, 0, ",")) {
    list($name, $birthday, $startedAt) = $data;
    $vacationDays = count($data) == 4 ? end($data) : 26;

    $birthday = date_create_from_format('d.m.Y', $birthday);
    $startedAt = date_create_from_format('d.m.Y', $startedAt);

    $employees[] = new Employee(
        $name,
        new Birthday(
            $birthday->format('Y'),
            $birthday->format('m'),
            $birthday->format('d')
        ),
        new StartedAt(
            $startedAt->format('Y'),
            $startedAt->format('m'),
            $startedAt->format('d')
        ),
        new VacationDays($vacationDays)
    );
}

fclose($handle);

echo PHP_EOL;
echo 'Requested date: ', $requestedAt()->format('Y-m-d');
echo PHP_EOL;
echo PHP_EOL;

$calculate = new Calculate();

foreach ($employees as $employee) {
    $calculated = $calculate($employee, $requestedAt, $full);

    echo "Name: ", $employee, " - Vacation Days: ", $calculated;
    echo PHP_EOL;
}

echo PHP_EOL;