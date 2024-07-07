<?php

namespace App\Tests;

use App\Services\Generators\ArrayGeneratorService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ArrayGeneratorServiceTest extends TestCase
{
    protected object $generator;
    protected mixed $length;

    protected function setUp(): void
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../config'));
        $loader->load('services.yaml');
        $this->length = $container->getParameter('array_generator.length');
        $this->generator = $container->get(ArrayGeneratorService::class);
    }

    public function testIsArray(): void
    {
        $result = $this->generator->generate();

        $this->assertIsArray($result);
    }

    public function testHasCorrectLength(): void
    {
        $result = count($this->generator->generate());

        $this->assertEquals($this->length, $result);
    }
}
