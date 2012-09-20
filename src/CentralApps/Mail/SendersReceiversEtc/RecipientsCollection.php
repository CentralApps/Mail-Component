<?php
namespace CentralApps\Mail\SendersReceiversEtc;

use \CentralApps\Mail\Collection;

class RecipientsCollection extends Collection {
	
	public $uniqueEmailsOnly = false;
	
	public function __construct($uniqueEmailsOnly=false)
	{
		$this->uniqueEmailsOnly = $uniqueEmailsOnly;
	}
	
	public function add(Recipient $recipient)
	{
		if( ! $this->uniqueEmailsOnly ) {
			$this->objects[] = $recipient;
		} else {
			if( ! array_key_exists( $recipient->getEmail(), $this->objects ) ) {
				$this->objects[ $recipient->getEmail() ] = $recipient;
			} else {
				throw new \Exception("Email already in recipients list");
			}
		}
	}
}
