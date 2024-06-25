<?php

use App\Services\Converters\NumberPatternConverterService;
use App\Services\Converters\Rot13ConverterService;
use App\Services\Generators\ArrayGeneratorService;
use App\Services\Generators\StringGeneratorService;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

require_once __DIR__ . '/vendor/autoload.php';

$container = new ContainerBuilder();

$container->setParameter('string_generator.length', 5);
$container->register(StringGeneratorService::class, StringGeneratorService::class)
    ->addArgument('%string_generator.length%');

$container->setParameter('array_generator.length', 10);
$container->register(ArrayGeneratorService::class, ArrayGeneratorService::class)
    ->addArgument('%array_generator.length%')
    ->addArgument(new Reference(StringGeneratorService::class));

$container->register(NumberPatternConverterService::class, NumberPatternConverterService::class);
$container->register(Rot13ConverterService::class, Rot13ConverterService::class);

//$stringGeneratorService = $container->get(StringGeneratorService::class);
//$response = $stringGeneratorService->generate();
//var_dump($response);

//$arrayGeneratorService = $container->get(ArrayGeneratorService::class);
//$response = $arrayGeneratorService->generate();
//var_dump($response);

//$rot13ConverterService = $container->get(Rot13ConverterService::class);
//$result = $rot13ConverterService->convert('22aAcd');
//var_dump($result);

//$numberPatternConverterService = $container->get(NumberPatternConverterService::class);
//$result = $numberPatternConverterService->convert('22aAcd');
//var_dump($result);