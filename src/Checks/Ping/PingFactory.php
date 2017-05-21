<?php

namespace Phizzl\HeartbeatTools\Checks\Ping;


use Phizzl\HeartbeatTools\Checks\Options;
use Phizzl\NetworkTools\Ping\Ping;

class PingFactory
{
    /**
     * @param Options $options
     * @return Ping
     */
    public function create(Options $options){
        return new Ping(
            $options->get('host'),
            $options->has('ttl') ? $options->get('ttl') : 255,
            $options->has('timeout') ? $options->get('ttl') : 10
        );
    }
}