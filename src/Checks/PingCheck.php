<?php


namespace Phizzl\HeartbeatTools\Checks;


use Phizzl\NetworkTools\Http\HttpHeader;
use Phizzl\NetworkTools\Http\HttpOptions;
use Phizzl\NetworkTools\Http\HttpRequest;
use Phizzl\NetworkTools\Ping\Ping;
use Psr\Http\Message\ResponseInterface;

class PingCheck extends AbstractCheck
{
    public function __construct(){
        parent::__construct();

        $this->requirements->addRequiredOption("host", CheckRequirements::TYPE_STRING);
    }

    /**
     * @throws CheckException
     * @return bool
     */
    protected function check(){
        $ping = new Ping(
            $this->options->get('host'),
            $this->options->has('ttl') ? $this->options->get('ttl') : 255,
            $this->options->has('timeout') ? $this->options->get('ttl') : 10
        );

        if($ping->ping() === false){
            throw new CheckException("Ping failed!");
        }

        return true;
    }
}