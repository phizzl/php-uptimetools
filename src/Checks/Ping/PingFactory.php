<?php

namespace Phizzl\HeartbeatTools\Checks\Ping;

use Phizzl\HeartbeatTools\Options\OptionsInterface;
use Phizzl\NetworkTools\Ping\Ping;

class PingFactory
{
    /**
     * @param OptionsInterface $options
     * @return Ping
     */
    public function create(OptionsInterface $options){
        return new Ping(
            $options->get('host'),
            $options->get('ttl'),
            $options->get('timeout')
        );
    }
}