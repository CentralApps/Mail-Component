<?php
namespace CentralApps\Mail\SendersReceiversEtc;

abstract class SenderReceiver
{
    protected $name = null;
    protected $email = null;

    public function __construct($email = null, $name = null)
    {
        if (!is_null($name)) {
            $this->setName($name);
        }
        if (!is_null($email)) {
            $this->setEmail($email);
        }
    }

    public function setName($name = null)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        if (filter_var($email, \FILTER_VALIDATE_EMAIL) !== false) {
            $this->email = $email;
        } else {
            throw new \CentralApps\Mail\Exceptions\InvalidEmailAddressException("Email address " . $email . " not valid");
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function __toString()
    {
        if (!is_null($this->name) && is_string($this->name)) {
            return $this->name . " <" . $this->email . ">";
        } else {
            return $this->email;
        }
    }
}
