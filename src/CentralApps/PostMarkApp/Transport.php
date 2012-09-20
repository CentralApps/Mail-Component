<?php
namespace CentralApps\PostMarkApp;

use \CentralApps\Mail\Message,
	\CentralApps\Mail\Transport;

class Transport implements Transport {
	
	protected $apiKey;
	protected $apiEndPoint;
	protected $permittedAttachmentTypes = array();
	protected $maxAttachmentSize;
	protected $maxNumAttachments = 0;
	
	protected $configurationMappings = array( 'api_key' => 'apiKey');
	
	
	protected $errors = array();
	
	public function __construct(Configuration $config)
	{
		foreach( $this->configurationMappings as $key => $mapping ) {
			if( array_key_exists( $config[ $key ] ) ) {
				 $this->$mapping = $config[ $key ];
			}
		}
	}
	
	public function interimAttachmentCheck($attachment)
	{
		
	}
	
	protected function attachmentsCheck(Message $message)
	{
		$attachments = $message->getAttachments();
		$this->attachmentCheckTooMany($attachments);
		$this->attachmentCheckTooBig($attachments);
		$this->attachmentCheckFileTypes($attachments);
	}
	
	protected function attachmentCheckTooMany($attachments)
	{
		if(count($attachments) > $this->maxNumAttachments) {
			$this->errors[] = "Too many attachments. Postmark app only permits " . $this->maxNumAttachments . " attachments per message";
		}
	}
	
	public function attachmentCheckTooBig($attachments)
	{
		$size = 0;
		foreach($attachments as $attachment) {
			$size += $attachment->getSize();
		}
		
		if( $size > $this->maxAttachmentSize ) {
			$this->errors[] = "Attachments too large, you have exceeded the attachment size limit for PostMarkApp";
		}
	}
	
	public function attachmentCheckFileTypes($attachments)
	{
		
	}
	
	
	
	
	
	public function send(Message $message)
	{
		$this->prepare();
		if(empty($this->errors)) {
			// do something
		} else {
			// throw something
		}
	}
	
}
