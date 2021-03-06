<?php

require __DIR__ . '/bootstrap.php';
require __DIR__ . '/Document/Foo.php';
require __DIR__ . '/Document/IdGenerator/Foo.php';

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\MongoDB\Connection;

$metadataDriverImpl = AnnotationDriver::create(__DIR__ . '/Document');

$config = new Configuration();
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');
$config->setHydratorDir(__DIR__ . '/Hydrators');
$config->setHydratorNamespace('Hydrators');
$config->setDefaultDB('test');
$config->setDocumentNamespaces(array('Document'));
$config->setMetadataDriverImpl($metadataDriverImpl);

$conn = new Connection(
    'mongodb://localhost:27017',
    array(),
    $config
);

$dm = DocumentManager::create($conn, $config);


/*
 * Test begin Here
 */

$fooId = time();

// Init first document
$document = new \Document\Foo();
$document->setFooId($fooId);
$document->setValue('Hello World');

// Insert
echo 'Insert First document (_id autogenerated by IdGenerator)' . PHP_EOL;
try{
    $dm->persist($document);
    $dm->flush();
    $dm->clear();
}catch (\Exception $e){
    echo $e->getMessage() . PHP_EOL . $e->getMessage() . PHP_EOL;
}

// Init second document
echo 'Insert Second document (same _id autogenerated by IdGenerator)' . PHP_EOL;
$newDocument = new \Document\Foo();
$newDocument->setFooId($fooId);
$newDocument->setValue('Hello MongoOdm');

$newDocument2 = new \Document\Foo();
$newDocument2->setFooId($fooId+1);
$newDocument2->setValue('Hello MongoOdm Next');

// Upsert
try{
    $dm->persist($newDocument);
    $dm->persist($newDocument2);
    $dm->flush(null, array('continueOnError' => true /*, 'ordered' => false*/));
    $dm->clear();
}catch (\Exception $e){
    echo $e->getMessage() . PHP_EOL . $e->getMessage() . PHP_EOL;
}
