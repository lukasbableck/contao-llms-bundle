<?php
namespace Lukasbableck\ContaoLlmsBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class ContaoLlmsBundle extends AbstractBundle {
	public function loadExtension(array $config, ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void {
		$containerConfigurator->import('../config/services.yaml');
	}
}
