# install
`composer install`

# test
`vendor/bin/phpunit t`

# execute
`php integration/calculate.php`

dump to a file
`php integration/calculate.php > myfile.txt`

against an specific date
`php integration/calculate.php 2019-12-31`

against an specific date (with full vacations)
`php integration/calculate.php 2019-12-31 true`