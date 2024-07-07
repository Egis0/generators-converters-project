<?php

namespace App\Services\Generators;

class StringGeneratorService implements GeneratorServiceInterface
{
    /** @var  array<int|string> */
    private readonly array $characters;
    private readonly int $charactersMaxIndex;

    public function __construct(private readonly int $length)
    {
        $this->characters = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
        $this->charactersMaxIndex = count($this->characters) - 1;
    }

    public function generate(): string
    {
        $string = '';
        for ($i = 0; $i < $this->length; $i++) {
            $string .= $this->characters[random_int(0, $this->charactersMaxIndex)];
        }

        return $string;
    }
}
