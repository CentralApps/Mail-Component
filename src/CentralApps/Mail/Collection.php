<?php
namespace CentralApps\Mail;

class Collection implements \Countable, \IteratorAggregate {
	
	private $objects = array();
	
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
}
