<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit997029f42cf8845b05949d70f4b36f4e
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit997029f42cf8845b05949d70f4b36f4e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit997029f42cf8845b05949d70f4b36f4e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}