<?php
namespace CentralApps\Mail\SendersReceiversEtc;

class RecipientsCollection extends \CentralApps\Mail\Collection
{
    public $uniqueEmailsOnly = false;

    public function __construct($uniqueEmailsOnly=false)
    {
        $this->uniqueEmailsOnly = $uniqueEmailsOnly;
    }

    public function add($recipient)
    {
        if (get_class($recipient) !== 'CentralApps\Mail\SendersReceiversEtc\Recipient') {
            throw new \InvalidArgumentException("Argument must be instance of the Recipient class");
        }
        if (!$this->uniqueEmailsOnly) {
            $this->objects[] = $recipient;
        } else {
            if (!array_key_exists($recipient->getEmail(), $this->objects)) {
                $this->objects[$recipient->getEmail()] = $recipient;
            } else {
                throw new \Exception("Email already in recipients list");
            }
        }
    }
}
