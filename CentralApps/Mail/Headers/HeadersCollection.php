<?php
namespace CentralApps\Mail\Headers;

class HeadersCollection extends \CentralApps\Mail\Collection
{
    public function add($header)
    {
        if (get_class($header) !== 'CentralApps\Mail\Headers\Header') {
            throw new \InvalidArgumentException("Argument must be instance of the Header class");
        }
        $this->objects[] = $header;
    }
}
