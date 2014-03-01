<?php
namespace CentralApps\Mail;

class Fetcher
{
    protected $messages = array();
    protected $transportEngine;

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

    public function fetch()
    {

    }
}
