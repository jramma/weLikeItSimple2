<?php

/**
 * Theme setup.
 */

namespace App;

$files  = scandir(__DIR__ . '/Base');

foreach ($files as $file) {
    if ($file === '.' || $file === '..') {
        continue;
    }

    require_once __DIR__ . '/Base/' . $file;

    $className = "\App\Base\\" . basename($file, ".php");

    if (class_exists($className) && !(new \ReflectionClass($className))->isAbstract()) {
        new $className();
    }
}
