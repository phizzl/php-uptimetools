<?php


namespace Phizzl\HeartbeatTools\Context;


use Phizzl\HeartbeatTools\Checks\CheckInterface;

class DispatchedCheckContext
{
    /**
     * @var CheckInterface
     */
    private $check;

    /**
     * @return CheckInterface
     */
    public function getCheck(){
        return $this->check;
    }

    /**
     * @param CheckInterface $check
     */
    public function setCheck($check){
        $this->check = $check;
    }
}