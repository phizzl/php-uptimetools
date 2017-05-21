<?php

namespace Phizzl\HeartbeatTools\Dispatcher;


use Phizzl\HeartbeatTools\Buckets\CheckBag;
use Phizzl\HeartbeatTools\Checks\CheckException;
use Phizzl\HeartbeatTools\Checks\CheckInterface;
use Phizzl\HeartbeatTools\Checks\DispatchedCheck;

class CheckDispatcher
{
    /**
     * @param CheckBag $checkBag
     * @return array
     */
    public function dispatch(CheckBag $checkBag){
        $return = [];
        /* @var CheckInterface $checkBag */
        foreach($checkBag->all() as $check){
            $return[] = $this->runCheck($check);
        }

        return $return;
    }

    /**
     * @param CheckInterface $check
     * @return DispatchedCheck
     */
    public function runCheck(CheckInterface $check){
        $dispatchedCheck = new DispatchedCheck();
        $dispatchStartTime = microtime(true);
        $returnValue = null;

        try{
            $returnValue = $check->run();
            $dispatchedCheck->setReturnValue($returnValue);
            $dispatchedCheck->setStatus(DispatchedCheck::STATUS_SUCCESS);
        }
        catch(CheckException $e){
            $dispatchedCheck->setMessage($e->getMessage());
            $dispatchedCheck->setStatus(DispatchedCheck::STATUS_FAILED);
        }
        $dispatchedCheck->setDispatchTime(microtime(true) - $dispatchStartTime);
        $dispatchedCheck->getContext()->setCheck($check);

        return $dispatchedCheck;
    }

}