<?php


namespace Phizzl\UptimeTools\Checks\Tcp;


use Phizzl\UptimeTools\Checks\AbstractCheck;
use Phizzl\UptimeTools\Checks\CheckException;
use Phizzl\UptimeTools\Checks\Requirements\Requirement;
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

        $this->requirements->addRequirement(new Requirement("host", Requirement::TYPE_NOTEMPTY));
        $this->requirements->addRequirement(new Requirement("host", Requirement::TYPE_STRING));
        $this->requirements->addRequirement(new Requirement("port", Requirement::TYPE_NOTEMPTY));
        $this->requirements->addRequirement(new Requirement("port", Requirement::TYPE_INTEGER));

        $this->options->set('timeout', 30);
    }

    /**
     * @throws CheckException
     * @return bool
     */
    public function run(){
        $this->tcp->setHost($this->options->get('host'));
        $this->tcp->setPort($this->options->get('port'));
        $this->tcp->setTimeout($this->options->get('timeout'));

        if(!$this->tcp->send()){
            throw new CheckException(
                "Cannot connect to port \"{$this->options->get('host')}:{$this->options->get('port')}\"."
                . "{$this->tcp->getErrstr()} ({$this->tcp->getErrno()})");
        }

        return true;
    }
}