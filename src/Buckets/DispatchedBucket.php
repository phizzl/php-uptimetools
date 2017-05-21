<?php

namespace Phizzl\HeartbeatTools\Buckets;


use Phizzl\HeartbeatTools\Checks\DispatchedCheck;

class DispatchedBucket
{
    const STATUS_SUCCESS = DispatchedCheck::STATUS_SUCCESS;

    const STATUS_FAILED = DispatchedCheck::STATUS_FAILED;

    /**
     * @var array
     */
    private $dispatchedChecks;

    public function __construct(){
        $this->dispatchedChecks = [];
    }

    /**
     * @param array $dispatchedChecks
     */
    public function setDispatchedChecks(array $dispatchedChecks){
        $this->dispatchedChecks = $dispatchedChecks;
    }

    /**
     * @return array
     */
    public function getDispatchedChecks(){
        return $this->dispatchedChecks;
    }

    /**
     * @return array
     */
    public function getFailedDispatchedChecks(){
        return array_filter($this->getDispatchedChecks(), function(DispatchedCheck $dispatchedCheck){
            return $dispatchedCheck->getStatus() === DispatchedCheck::STATUS_FAILED;
        });
    }

    /**
     * @return array
     */
    public function getSucceededDispatchedChecks(){
        return array_filter($this->getDispatchedChecks(), function(DispatchedCheck $dispatchedCheck){
            return $dispatchedCheck->getStatus() === DispatchedCheck::STATUS_SUCCESS;
        });
    }

    /**
     * @return int
     */
    public function getStatus(){
        $return = self::STATUS_SUCCESS;
        /* @var DispatchedCheck $dispatchedCheck */
        foreach($this->dispatchedChecks as $dispatchedCheck){
            if($dispatchedCheck->getStatus() === DispatchedCheck::STATUS_FAILED){
                $return = self::STATUS_FAILED;
                break;
            }
        }

        return $return;
    }

    /**
     * @return float
     */
    public function getDispatchTime(){
        $dispatchTime = .0;
        array_map(function(DispatchedCheck $dispatchedCheck) use (&$dispatchTime){
            $dispatchTime += $dispatchedCheck->getDispatchTime();
        }, $this->getDispatchedChecks());

        return $dispatchTime;
    }
}