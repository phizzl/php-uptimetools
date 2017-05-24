<?php


namespace Phizzl\UptimeTools\Contexts;


use Phizzl\UptimeTools\Checks\CheckInterface;

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