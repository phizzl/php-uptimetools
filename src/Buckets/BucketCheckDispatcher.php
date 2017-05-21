<?php

namespace Phizzl\HeartbeatTools\Buckets;


use Phizzl\HeartbeatTools\Checks\CheckException;
use Phizzl\HeartbeatTools\Checks\CheckInterface;

class BucketCheckDispatcher
{
    public function dispatch(CheckBag $checkBag){
        /* @var CheckInterface $checkBag */
        foreach($checkBag->all() as $check){
            $this->runCheck($check);
        }
    }

    public function runCheck(CheckInterface $check){
        try{
            $check->run();
        }
        catch(CheckException $e){

        }
    }

}