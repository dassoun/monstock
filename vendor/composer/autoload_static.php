<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdbf2db3968302d80e41057b689a1c96a
{
    public static $prefixesPsr0 = array (
        'Z' => 
        array (
            'Zend_' => 
            array (
                0 => __DIR__ . '/..' . '/zendframework/zendframework1/library',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitdbf2db3968302d80e41057b689a1c96a::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
