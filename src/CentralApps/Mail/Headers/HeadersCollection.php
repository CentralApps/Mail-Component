<?php
namespace CentralApps\Mail\Headers;

use \CentralApps\Mail\Collection;

class HeadersCollection extends Collection {
	
	public function add(Header $header)
	{
		$this->objects[] = $header;
	}
	
}
