<?php

namespace Desarrolla2\Bundle\TwitterClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('twitter_client')
            ->children()
                ->scalarNode('consumer_key')
                ->end()
            ->end()
            ->children()
                ->scalarNode('consumer_secret')
                ->end()
            ->end()
            ->children()
                ->scalarNode('token')
                ->end()
            ->end()
            ->children()
                ->scalarNode('token_secret')
                ->end()
            ->end()
            ;

        return $treeBuilder;
    }
}
