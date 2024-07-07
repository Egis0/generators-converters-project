<?php

namespace App\Services\Converters;

class Rot13ConverterService extends AbstractConverterService
{
    public function execute(string $string): string
    {
        return str_rot13($string);
    }
}
