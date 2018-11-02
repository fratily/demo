<?php
namespace App\Container;

/**
 *
 */
class TwigContainer extends \Fratily\Container\Builder\AbstractContainer{

    public static function build(\Fratily\Container\Builder\ContainerBuilder $builder, array $options){
        $builder
            ->add(
                "app.twig.loader",
                $builder->lazy(
                    function(\Fratily\Kernel\Kernel $kernel){
                        return new \Twig_Loader_Filesystem(
                            $kernel->getConfig()->getProjectDir() . "/template"
                        );
                    }
                ),
                ["twig.loader"]
            )
        ;
    }
}
