<?php

namespace App\Services\Generators;

interface GeneratorServiceInterface
{
    /**
     * @return string|string[]
     */
    public function generate(): string|array;
}
