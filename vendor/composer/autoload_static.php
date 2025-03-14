<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf2e810aa1bcab7f21c3533aa9075c141
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'setasign\\Fpdi\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'setasign\\Fpdi\\' => 
        array (
            0 => __DIR__ . '/..' . '/setasign/fpdi/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'FPDF' => __DIR__ . '/..' . '/setasign/fpdf/fpdf.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf2e810aa1bcab7f21c3533aa9075c141::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf2e810aa1bcab7f21c3533aa9075c141::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf2e810aa1bcab7f21c3533aa9075c141::$classMap;

        }, null, ClassLoader::class);
    }
}
