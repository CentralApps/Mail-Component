<?php
namespace CentralApps\Mail;

class Collection implements \Countable, \IteratorAggregate
{
    protected $objects = array();

    public function add($object)
    {
        $this->objects[] = $object;
    }

    public function count()
    {
        return count($this->objects);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->objects);
    }

    public function flattern()
    {
        $tor = array();
        foreach ($this->objects as $object) {
            $tor[] = (string) $object;
        }

        return $tor;
    }
}
