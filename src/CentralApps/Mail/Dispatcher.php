<?php
namespace CentralApps\Mail;

class Dispatcher {
	
	private $transportEngine;
	
	public function __construct(Transport $transportEngine=null )
	{
		if( !is_null($transportEngine)) {
			$this->setTransportEngine( $transportEngine );
		}
	}
	
	public function setTransportEngine(Transport $transportEngine)
	{
		$this->transportEngine = $transportEngine;
	}
	
	public function send(Message $message)
	{
		try{
			$this->transportEngine->send($message);
		} catch (\Exception $e ) {
			return false;
		}
		return true;
	}
}
