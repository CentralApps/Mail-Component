<?php
namespace CentralApps\Mail;

class Fetcher {
	
	protected $messages = array();
	protected $transportEngine;
	
	public function __construct(Transport $transportEngine=null)
	{
		if(!is_null($transportEngine)) {
			$this->setTransportEngine($transportEngine);
		}
	}
	
	public function setTransportEngine(Transport $transportEngine)
	{
		$this->transportEngine = $transportEngine;
	}
	
	public function fetch()
	{
		
	}
	
}
