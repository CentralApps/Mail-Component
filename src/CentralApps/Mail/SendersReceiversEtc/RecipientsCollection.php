<?php
namespace CentralApps\Mail\SendersReceiversEtc;

use \CentralApps\Mail\Collection;

class RecipientsCollection extends Collection {
	
	public $uniqueEmailsOnly = false;
	
	public function __construct($uniqueEmailsOnly=false)
	{
		$this->uniqueEmailsOnly = $uniqueEmailsOnly;
	}
	
	public function add($recipient)
	{
		if(get_class($recipient) !== 'Recipient') {
			throw new \InvalidArgumentException("Argument must be instance of the Recipient class");
		}
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
