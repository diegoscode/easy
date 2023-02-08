<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitd044acbba43d2e1e608c2bfbfbe777ae
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitd044acbba43d2e1e608c2bfbfbe777ae', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitd044acbba43d2e1e608c2bfbfbe777ae', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitd044acbba43d2e1e608c2bfbfbe777ae::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
