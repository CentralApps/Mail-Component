<?php
namespace CentralApps\Mail;

class Dispatcher
{
    private $transportEngine;

    public function __construct(Transport $transport_engine = null)
    {
        if (!is_null($transport_engine)) {
            $this->setTransportEngine($transport_engine);
        }
    }

    public function setTransportEngine(Transport $transport_engine)
    {
        $this->transportEngine = $transport_engine;
    }

    public function send(Message $message)
    {
        try {
            $this->transportEngine->send($message);
        } catch (\Exception $e ) {
            return false;
        }

        return true;
    }
}
