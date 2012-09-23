<?php
namespace CentralApps\Mail;

interface Transport {
	
	public function __construct(Configuration $configuration);
	
	public function interimAttachmentCheck(\SplFileInfo $attachment);
	
	public function send(Message $message);
	
}
