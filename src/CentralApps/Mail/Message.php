<?php
namespace CentralApps\Mail;

abstract class Message {
	
	protected $sender;
	
	protected $to;
	protected $cc;
	protected $bcc;
	protected $headers;
	protected $replyTo=null;
	
	protected $subject = "";
	protected $plainTextMessage = null;
	protected $htmlMessage = null;
	
	protected $attachments;
	
	protected $recipientTypes = array('to', 'cc', 'bcc');
	
	public function __construct()
	{
		$recipientsCollection = new RecipientsCollection();
		$this->to = clone $recipientsCollection;
		$this->cc = clone $recipientsCollection;
		$this->bcc = clone $recipientsCollection;
		$this->headers = new HeadersCollection();
		$this->attachments = new Collection();
	}
	
	public function addAttachment($filePath)
	{
		$file = new \SplFileInfo($filePath);
		if( $file->isFile() && $file->isReadable() ) {
			$this->attachments[] = $file;
			return $file;
		} else {
			// throw new exception
		}
	}
	
	public function setSender(Sender $sender)
	{
		$this->sender = $sender;
	}
	
	public function getSender()
	{
		return $this->sender;
	}
	
	public function setReplyTo(ReplyTo $replyTo)
	{
		$this->replyTo = $replyTo;
	}
	
	public function setSubject($subject)
	{
		$this->subject = $subject;
	}
	
	public function getSubject()
	{
		return $this->subject;
	}
	
	public function setPlainTextMessage($message)
	{
		$this->plainTextMessage = $message;
	}
	
	public function setHtmlMessage($message)
	{
		$this->htmlMessage = $message;
	}
	
	public function addRecipient(Recipient $recipient, $type='to')
	{
		$type = ( in_array($type, $this->recipientTypes) ) ? $type : 'to';
		$this->$type->add($recipient);
	}
	
	public function getAllRecipients()
	{
		return array(
						'to' => $this->to,
						'cc' => $this->cc,
						'bcc' => $this->bcc
					);
	}
	
	public function getRecipientsByType($type)
	{
		if( in_array($type, $this->recipientTypes) ) {
			return $this->$type;
		} else {
			return array(); // or should we throw an exception?
		}
	}
	
}