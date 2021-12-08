<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit36b4a02ccafedc3b070e25aa4fbb1af6
{
    public static $files = array (
        'cfe4039aa2a78ca88e07dadb7b1c6126' => __DIR__ . '/../..' . '/config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pecee\\' => 6,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pecee\\' => 
        array (
            0 => __DIR__ . '/..' . '/pecee/simple-router/src/Pecee',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit36b4a02ccafedc3b070e25aa4fbb1af6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit36b4a02ccafedc3b070e25aa4fbb1af6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit36b4a02ccafedc3b070e25aa4fbb1af6::$classMap;

        }, null, ClassLoader::class);
    }
}
