<?php

namespace App\Services\Generators;

interface GeneratorServiceInterface
{
    public function generate(): string|array;
}