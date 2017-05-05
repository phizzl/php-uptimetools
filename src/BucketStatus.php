<?php

namespace Phizzl\HeartbeatTools;


use Phizzl\HeartbeatTools\Checks\CheckResponse;

class BucketStatus
{
    /**
     * @var array
     */
    private $checkResponses;

    public function __construct(){
        $this->checkResponses = [];
    }

    /**
     * @param CheckResponse $response
     */
    public function addCheckResponse(CheckResponse $response){
        $this->checkResponses[] = $response;
    }

    /**
     * @return bool
     */
    public function isOk(){
        $return = true;
        /* @var CheckResponse $checkResponse */
        foreach($this->checkResponses as $checkResponse){
            if($checkResponse->getStatus() == CheckResponse::STATUS_FAILED){
                $return = false;
                break;
            }
        }

        return $return;
    }

    public function clear(){
        $this->checkResponses = [];
    }

    /**
     * @return array
     */
    public function getFailedChecks(){
        return array_filter($this->checkResponses, function(CheckResponse $item){
            return $item->getStatus() == CheckResponse::STATUS_FAILED;
        });
    }
}