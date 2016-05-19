<?php

namespace Document\IdGenerator;

class Foo extends \Doctrine\ODM\MongoDB\Id\AbstractIdGenerator
{
    
    /* (non-PHPdoc)
     * @see \Doctrine\ODM\MongoDB\Id\AbstractIdGenerator::generate()
     */
    public function generate(\Doctrine\ODM\MongoDB\DocumentManager $dm, $document)
    {
        if(is_object($document)){
            if(!$document->getFooId()){
                throw new \Exception('fooId is required to make an id');
            }
            return md5($document->getFooId());
        }else{
            if(!isset($document['fooId'])){
                throw new \Exception('fooId is required to make an id');
            }
            return md5($document['fooId']);
        }
    }
    
}