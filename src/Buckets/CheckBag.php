<?php


namespace Phizzl\UptimeTools\Buckets;


use Phizzl\UptimeTools\Checks\CheckInterface;

class CheckBag
{
    /**
     * @var array
     */
    private $checks;

    public function __construct(){
        $this->checks = [];
    }

    /**
     * @param CheckInterface $check
     */
    public function addCheck(CheckInterface $check){
        $this->checks[] = $check;
    }

    /**
     * @return array
     */
    public function all(){
        return $this->checks;
    }
}