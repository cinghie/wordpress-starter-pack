<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita417e793a2a91963599b4f8d4312034c
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'URL\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'URL\\' => 
        array (
            0 => __DIR__ . '/..' . '/glenscott/url-normalizer/src/URL',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita417e793a2a91963599b4f8d4312034c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita417e793a2a91963599b4f8d4312034c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}