<?php

namespace App\Services\Generators;

class ArrayGeneratorService implements GeneratorServiceInterface
{
    public function __construct(
        private readonly int $length,
        private readonly GeneratorServiceInterface $generatorService
    ) {}

    public function generate(): array
    {
        $array = [];
        for ($i = 0; $i < $this->length; $i++) {
            $array[] = $this->generatorService->generate();
        }

        return $array;
    }
}