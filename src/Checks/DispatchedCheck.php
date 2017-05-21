<?php


namespace Phizzl\HeartbeatTools\Checks;


use Phizzl\HeartbeatTools\Contexts\DispatchedCheckContext;

class DispatchedCheck
{
    const STATUS_SUCCESS = 1;

    const STATUS_FAILED = 2;

    /**
     * @var float
     */
    private $dispatchTime;

    /**
     * @var int
     */
    private $status;

    /**
     * @var mixed
     */
    private $returnValue;

    /**
     * @var string
     */
    private $message;

    /**
     * @var DispatchedCheckContext
     */
    private $context;

    /**
     * DispatchedCheck constructor.
     * @param float $dispatchTime
     * @param int $status
     * @param mixed $returnValue
     * @param string $message
     */
    public function __construct($dispatchTime = .0, $status = self::STATUS_FAILED, $returnValue = null, $message = ""){
        $this->dispatchTime = .0;
        $this->status = self::STATUS_FAILED;
        $this->returnValue = null;
        $this->message = "";
        $this->context = new DispatchedCheckContext();
    }

    /**
     * @return float
     */
    public function getDispatchTime(){
        return $this->dispatchTime;
    }

    /**
     * @param float $dispatchTime
     */
    public function setDispatchTime($dispatchTime){
        $this->dispatchTime = (float)$dispatchTime;
    }

    /**
     * @return int
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status){
        $this->status = (int)$status;
    }

    /**
     * @return mixed
     */
    public function getReturnValue(){
        return $this->returnValue;
    }

    /**
     * @param mixed $returnValue
     */
    public function setReturnValue($returnValue){
        $this->returnValue = $returnValue;
    }

    /**
     * @return string
     */
    public function getMessage(){
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message){
        $this->message = (string)$message;
    }

    /**
     * @return DispatchedCheckContext
     */
    public function getContext(){
        return $this->context;
    }

    /**
     * @param DispatchedCheckContext $context
     */
    public function setContext(DispatchedCheckContext $context){
        $this->context = $context;
    }
}