<?php

namespace App\Services\Converters;

class NumberPatternConverterService extends AbstractConverterService
{
    private readonly array $alphabet;

    public function __construct() {
        $this->alphabet = range('a', 'z');
    }

    protected function execute(string $string): string
    {
        $convertedString = '';
        $length = strlen($string);
        for ($i = 0; $i < $length; $i++) {
            if (is_numeric($string[$i])) {
                $convertedString .= $string[$i];
            } else {
                $convertedString .= '/' . (array_search(strtolower($string[$i]), $this->alphabet) + 1) . '/';
            }
        }

        return str_replace('//', '/', trim($convertedString, '/'));
    }
}