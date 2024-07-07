<?php

namespace App\Services\Converters;

abstract class AbstractConverterService
{
    /**
     * @param string|string[] $convertee
     * @return string|string[]
     */
    public function convert(string|array $convertee): string|array
    {
        if (is_array($convertee)) {
            $converted = [];
            foreach ($convertee as $converteeInner) {
                $converted[] = $this->execute($converteeInner);
            }

            return $converted;
        }

        return $this->execute($convertee);
    }

    abstract public function execute(string $string): string;
}
