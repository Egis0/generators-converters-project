<?php

namespace App\Tests;

use App\Services\Converters\NumberPatternConverterService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class NumberPatternConverterServiceTest extends TestCase
{
    protected object $converter;

    protected function setUp(): void
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../config'));
        $loader->load('services.yaml');
        $this->converter = $container->get(NumberPatternConverterService::class);
    }

    public function testIsExecutedCorrectly(): void
    {
        $result = $this->converter->execute('22aAcd');

        $this->assertEquals('22/1/1/3/4', $result);
    }

    public function testNumberWontBeChanged(): void
    {
        $result = $this->converter->execute('223457');

        $this->assertEquals('223457', $result);
    }

    public function testNumberWontBeSeparatedWithSlashes(): void
    {
        $result = $this->converter->execute('A457c');

        $this->assertEquals('1/457/3', $result);
    }

    public function testEmptyStringReturnsEmpty(): void
    {
        $result = $this->converter->execute('');

        $this->assertEquals('', $result);
    }

    public function testUppercaseAndLowercaseConvertedSame(): void
    {
        $result = $this->converter->execute('aAbBzZ');

        $this->assertEquals('1/1/2/2/26/26', $result);
    }

    public function testSlashIsAddedBetweenLetters(): void
    {
        $result = $this->converter->execute('aAbBzZ');

        $this->assertEquals('1/1/2/2/26/26', $result);
    }

    public function testSlashesAreOnlyBetweenCharacters(): void
    {
        $result = $this->converter->execute('agJ123');

        $this->assertEquals('1/7/10/123', $result);
    }
}
