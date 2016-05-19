<?php

namespace Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="Foo")
 */
class Foo
{

    /**
     * @MongoDB\Id(strategy="CUSTOM", type="string", options={"class"="\Document\IdGenerator\Foo"})
     */
    public $id;

    /**
     * @MongoDB\Field(type="int")
     */
    public $fooId = array();

    /**
     * @MongoDB\Field(type="string")
     */
    public $value;

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return the $fooId
     */
    public function getFooId()
    {
        return $this->fooId;
    }

    /**
     *
     * @return the $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     *
     * @param field_type $id            
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param multitype: $fooId            
     */
    public function setFooId($fooId)
    {
        $this->fooId = $fooId;
    }

    /**
     *
     * @param field_type $value            
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}