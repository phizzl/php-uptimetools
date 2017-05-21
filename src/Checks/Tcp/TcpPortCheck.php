<?php


namespace Phizzl\HeartbeatTools\Checks\Tcp;


use Phizzl\HeartbeatTools\Checks\AbstractCheck;
use Phizzl\HeartbeatTools\Checks\CheckException;
use Phizzl\HeartbeatTools\Checks\CheckRequirements;
use Phizzl\NetworkTools\Tcp\Tcp;

class TcpPortCheck extends AbstractCheck
{
    /**
     * @var Tcp
     */
    private $tcp;

    public function __construct(){
        parent::__construct();
        $this->tcp = new Tcp();

        $this->requirements->addRequiredOption("host", CheckRequirements::TYPE_STRING);
        $this->requirements->addRequiredOption("port", CheckRequirements::TYPE_INT);
    }

    /**
     * @throws CheckException
     * @return bool
     */
    protected function check(){
        $this->tcp->setHost($this->options->get('host'));
        $this->tcp->setPort($this->options->get('port'));

        if($this->options->has('timeout')){
            $this->tcp->setTimeout($this->options->get('timeout'));
        }

        if(!$this->tcp->send()){
            throw new CheckException("Cannot connect to port \"{$this->options->get('port')}\". {$tcp->getErrstr()} ({$tcp->getErrno()})");
        }

        return true;
    }
}