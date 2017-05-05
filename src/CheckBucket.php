<?php


namespace Phizzl\HeartbeatTools;


use Phizzl\HeartbeatTools\Checks\CheckInterface;

class CheckBucket
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $checklist;

    /**
     * @var BucketStatus
     */
    private $bucketStatus;

    /**
     * CheckBucket constructor.
     */
    public function __construct(){
        $this->name = "";
        $this->checklist = [];
        $this->bucketStatus = new BucketStatus();
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
     * @param CheckInterface $check
     */
    public function addCheck(CheckInterface $check){
        $this->checklist[] = $check;
    }

    /**
     * @return BucketStatus
     */
    public function run(){
        $this->bucketStatus->clear();
        /* @var CheckInterface $check */
        foreach($this->checklist as $check){
            $this->bucketStatus->addCheckResponse($check->run());
        }

        return $this->getBucketStatus();
    }

    /**
     * @return BucketStatus
     */
    public function getBucketStatus(){
        return $this->bucketStatus;
    }
}