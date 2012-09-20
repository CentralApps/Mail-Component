<?php
namespace CentralApps\Mail\SendersReceiversEtc;

abstract class SenderReceiver {
	
	protected $name=null;
	protected $email;
	
	public function setName($name=null)
	{
		$this->name = $name;
	}
	
	public function setEmail($email)
	{
		if( filter_var($email, \FILTER_VALIDATE_EMAIL) !== false ) {
			$this->email = $email;
		} else {
			throw new Exceptions\InvalidEmailAddressException("Email address " . $email . " not valid");
		}
	}
	
	public function __toString()
	{
		if(!is_null($this->name)) {
			return $this->name . " <" . $this->email . ">";
		} else {
			return $this->email;
		}
	}
}
