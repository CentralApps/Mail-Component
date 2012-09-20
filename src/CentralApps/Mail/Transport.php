<?php
namespace CentralApps\Mail;

interface Transport {
	
	public function __construct(Configuration $configuration);
	
	public function send(Message $message);
	
}
