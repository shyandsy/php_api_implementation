<?php
namespace App\Core;

class Psr4Autoloader{
    protected static string $prefix = "";
    protected static string $folder = "";

    public static function initAutoLoader(string $namespace, string $dir): void{
        self::addNamespace($namespace, $dir);
        spl_autoload_register([self::class, 'autoload']);
    }

    private static function addNamespace(string $prefix, string $baseDir): void {
        self::$prefix = rtrim($prefix, '\\') . '\\';
        self::$folder = rtrim($baseDir, DIRECTORY_SEPARATOR) . '/';
        echo self::$prefix . "==> " . self::$folder . "<br>";
    }

    // PSR4: Autoloader implementation

    /**
     * @throws \Exception
     */
    private static function autoload($className): void {
        if (class_exists($className, false) || interface_exists($className, false) || trait_exists($className, false)) {
            return;
        }

        if (!str_starts_with($className, self::$prefix)){
            throw new \Exception("namespace not found: " . $className . ", prefix: " . self::$prefix . "<br>");
        }

        $relativeClass = substr($className, strlen(self::$prefix));
        $file = self::$folder . '/' . str_replace('\\', '/', $relativeClass) . '.php';

        // echo "prefix length: " . strlen(self::$prefix) . ", prefix = " . self::$prefix . "<br>";
        // echo "className length: " . strlen($className) . "className = " . $className . "<br>";
        // echo "load file for class name from: $relativeClass<br>";
        // echo "load file: $file<br>";

        if (!file_exists($file)) {
            throw new \Exception("class file not found: $className . path: $file<br>");
        }

        require $file;
    }
}
