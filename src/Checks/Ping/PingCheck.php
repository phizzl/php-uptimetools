<?php


namespace Phizzl\HeartbeatTools\Checks\Ping;

use Phizzl\HeartbeatTools\Checks\AbstractCheck;
use Phizzl\HeartbeatTools\Checks\CheckException;
use Phizzl\HeartbeatTools\Checks\CheckRequirements;

class PingCheck extends AbstractCheck
{
    /**
     * @var PingFactory
     */
    private $factory;

    public function __construct(){
        parent::__construct();
        $this->factory = new PingFactory();

        $this->requirements->addRequiredOption("host", CheckRequirements::TYPE_STRING);
    }

    /**
     * @throws CheckException
     * @return bool
     */
    protected function check(){
        $ping = $this->factory->create($this->options);

        if($ping->ping() === false){
            throw new CheckException("Ping failed!");
        }

        return true;
    }

    protected function createPing(){

    }
}