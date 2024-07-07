<?php

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

require_once __DIR__ . '/vendor/autoload.php';

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/config'));
$loader->load('services.yaml');

$generatorClassNames = $converterClassNames = [];
foreach (array_keys($container->getDefinitions()) as $serviceName) {
    if (str_starts_with($serviceName, 'App\Services\Generators')) {
        $generators[] = $container->get($serviceName);
    }
    if (str_starts_with($serviceName, 'App\Services\Converters')) {
        $converters[] = $container->get($serviceName);
    }
}

if (empty($generators)) {
    throw new Exception('Container doesn\'t have any generators');
}

$generatorsMaxIndex = max(0, count($generators) - 1);
$generatorsCollection = new ArrayCollection();
for ($i = 0; $i < 10; $i++) {
    $generatorsCollection->add($generators[random_int(0, $generatorsMaxIndex)]->generate());
}
print_r($generatorsCollection);

if (empty($converters)) {
    throw new Exception('Container doesn\'t have any converters');
}

$convertersMaxIndex = max(0, count($converters) - 1);
$convertedCollection = $generatorsCollection->map(function ($value) use ($convertersMaxIndex, $converters) {
    return $converters[random_int(0, $convertersMaxIndex)]->convert($value);
});
print_r($convertedCollection);
