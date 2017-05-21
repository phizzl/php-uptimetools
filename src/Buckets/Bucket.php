<?php


namespace Phizzl\HeartbeatTools\Buckets;


use Phizzl\HeartbeatTools\Dispatcher\BucketDispatcher;

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

    private $dispatcher;

    /**
     * CheckBucket constructor.
     */
    public function __construct(){
        $this->name = "";
        $this->checks = new CheckBag();
        $this->dispatcher = new BucketDispatcher();
    }

    /**
     * @param BucketDispatcher $dispatcher
     */
    public function setDispatcher(BucketDispatcher $dispatcher){
        $this->dispatcher = $dispatcher;
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

    public function run(){
        return $this->dispatcher->dispatch($this);
    }
}