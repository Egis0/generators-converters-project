# Generators-converters project

## Installing

```
composer install
```

## Configuration

Project configurations are in config/services.yaml file

## Executing program

```
php index.php
```

## Running analysis, tests

```
vendor/bin/phpcs --standard=PSR12 src tests index.php
vendor/bin/phpstan analyse
vendor/bin/phpunit tests --color --testdox
```