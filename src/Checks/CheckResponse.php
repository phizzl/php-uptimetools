<?php


namespace Phizzl\HeartbeatTools\Checks;


class CheckResponse
{
    const STATUS_SUCCESS = 1;

    const STATUS_FAILED = 0;

    /**
     * @var int
     */
    private $status;

    /**
     * @var float
     */
    private $responseTime;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $name;

    public function __construct(){
        $this->status = self::STATUS_FAILED;
        $this->responseTime = .0;
        $this->message = "";
        $this->name = "";
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
     * @return mixed
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status){
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getResponseTime(){
        return $this->responseTime;
    }

    /**
     * @param mixed $responseTime
     */
    public function setResponseTime($responseTime){
        $this->responseTime = $responseTime;
    }

    /**
     * @return mixed
     */
    public function getMessage(){
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message){
        $this->message = $message;
    }
}