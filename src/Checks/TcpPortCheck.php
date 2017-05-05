<?php


namespace Phizzl\HeartbeatTools\Checks;


use Phizzl\NetworkTools\Http\HttpHeader;
use Phizzl\NetworkTools\Http\HttpOptions;
use Phizzl\NetworkTools\Http\HttpRequest;
use Phizzl\NetworkTools\Ping\Ping;
use Phizzl\NetworkTools\Tcp\Tcp;
use Psr\Http\Message\ResponseInterface;

class TcpPortCheck extends AbstractCheck
{
    public function __construct(){
        parent::__construct();

        $this->requirements->addRequiredOption("host", CheckRequirements::TYPE_STRING);
        $this->requirements->addRequiredOption("port", CheckRequirements::TYPE_INT);
    }

    /**
     * @throws CheckException
     * @return bool
     */
    protected function check(){
        $tcp = new Tcp();
        $tcp->setHost($this->options->get('host'));
        $tcp->setPort($this->options->get('port'));

        if($this->options->has('timeout')){
            $tcp->setTimeout($this->options->get('timeout'));
        }

        if(!$tcp->send()){
            throw new CheckException("Cannot connect to port \"{$this->options->get('port')}\". {$tcp->getErrstr()} ({$tcp->getErrno()})");
        }

        return true;
    }
}