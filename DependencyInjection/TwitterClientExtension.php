<?php

namespace Desarrolla2\Bundle\TwitterClientBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TwitterClientExtension extends Extension
{

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('twitter_client.consumer_key', $config['consumer_key']);
        $container->setParameter('twitter_client.consumer_secret', $config['consumer_secret']);
        $container->setParameter('twitter_client.token', $config['token']);
        $container->setParameter('twitter_client.token_secret', $config['token_secret']);

        if (isset($config['screen_name'])) {
            $container->setParameter('twitter_client.screen_name', $config['screen_name']);
        } else {
            $container->setParameter('twitter_client.screen_name', null);
        }
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'twitter_client';
    }
}
