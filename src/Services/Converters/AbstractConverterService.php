<?php

namespace App\Services\Converters;

abstract class AbstractConverterService
{
    public function convert(string|array $convertee): string|array
    {
        if (is_array($convertee)) {
            $converted = [];
            foreach ($convertee as $converteeInner) {
                $converted[] = $this->convert($converteeInner);
            }

            return $converted;
        }

        return $this->execute($convertee);
    }

    abstract protected function execute(string $string): string;
}