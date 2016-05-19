<?php

if (!file_exists($file = __DIR__.'/vendor/autoload.php')) {
    throw new RuntimeException('Install dependencies to run test.');
}

$loader = require $file;
$loader->add('Document', __DIR__ . '\Documment');
\Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::registerAnnotationClasses();