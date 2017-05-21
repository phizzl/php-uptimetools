<?php


namespace Phizzl\HeartbeatTools\Checks\Ping;

use Phizzl\HeartbeatTools\Checks\AbstractCheck;
use Phizzl\HeartbeatTools\Checks\CheckException;
use Phizzl\HeartbeatTools\Checks\Requirements\Requirement;

class PingCheck extends AbstractCheck
{
    /**
     * @var PingFactory
     */
    private $factory;

    public function __construct(){
        parent::__construct();
        $this->factory = new PingFactory();

        $this->requirements->addRequirement(new Requirement("host", Requirement::TYPE_NOTEMPTY));
        $this->requirements->addRequirement(new Requirement("host", Requirement::TYPE_STRING));

        $this->options->set('ttl', 255);
        $this->options->set('timeout', 10);
    }

    /**
     * @throws CheckException
     * @return bool
     */
    public function run(){
        $ping = $this->factory->create($this->options);

        if($ping->ping() === false){
            throw new CheckException("Ping failed!");
        }

        return true;
    }

    protected function createPing(){

    }
}