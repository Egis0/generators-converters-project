<?php

namespace App\Tests;

use App\Services\Generators\StringGeneratorService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class StringGeneratorServiceTest extends TestCase
{
    protected object $generator;
    protected mixed $length;

    protected function setUp(): void
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../config'));
        $loader->load('services.yaml');
        $this->length = $container->getParameter('string_generator.length');
        $this->generator = $container->get(StringGeneratorService::class);
    }

    public function testIsString(): void
    {
        $result = $this->generator->generate();

        $this->assertIsString($result);
    }

    public function testIsAlphanumerical(): void
    {
        $result = ctype_alnum($this->generator->generate());

        $this->assertTrue($result);
    }

    public function testHasCorrectLength(): void
    {
        $result = strlen($this->generator->generate());

        $this->assertEquals($this->length, $result);
    }
}
