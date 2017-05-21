<?php


namespace Phizzl\HeartbeatTools\Buckets;


use Phizzl\HeartbeatTools\Checks\CheckInterface;

class Bucket
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var CheckBag
     */
    private $checks;

    /**
     * CheckBucket constructor.
     */
    public function __construct(){
        $this->name = "";
        $this->checks = new CheckBag();
    }

    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * @param CheckBag $checks
     */
    public function setChecks(CheckBag $checks){
        $this->checks = $checks;
    }

    /**
     * @return CheckBag
     */
    public function getChecks(){
        return $this->checks;
    }
}