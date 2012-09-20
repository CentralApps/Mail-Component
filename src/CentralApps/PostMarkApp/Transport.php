<?php
namespace CentralApps\PostMarkApp;

use \CentralApps\Mail\Message,
	\CentralApps\Mail\Transport;

class Transport implements Transport {
	
	protected $apiKey;
	protected $apiEndPoint = 'http://api.postmarkapp.com/email';
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
		$email = $message->generateSendableArray();
		if(empty($this->errors)) {
			// do something
			$this->sendViaPostmarkApp($email);
		} else {
			// throw something
		}
	}
	
	protected function sendViaPostmarkApp($sendableEmail)
	{
		
		$email = json_encode( $sendableEmail );
		
		$headers = array(
			'Accept: application/json',
			'Content-Type: application/json',
			'X-Postmark-Server-Token: ' . $this->apiKey
		);
		
		$ch = curl_init();
		curl_setopt($ch, \CURLOPT_URL, $this->apiEndPoint );
		curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, \CURLOPT_POSTFIELDS, $email);
		curl_setopt($ch, \CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($ch);
		$error = curl_error($ch);
		$cleaned_response = json_decode( $response );
		if( curl_getinfo($ch, \CURLINFO_HTTP_CODE) == 200 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
}
