<?php


namespace Phizzl\HeartbeatTools\Checks;


abstract class AbstractCheck implements CheckInterface
{
    /**
     * @var CheckRequirements
     */
    protected $requirements;

    /**
     * @var Options
     */
    protected $options;

    public function __construct(){
        $this->options = new Options();
        $this->requirements = new CheckRequirements();
    }

    /**
     * @param Options $options
     */
    public function setOptions(Options $options){
        $this->options = $options;
    }

    /**
     * @return CheckRequirements
     */
    public function getRequirements(){
        return $this->requirements;
    }

    /**
     * @return CheckResponse
     */
    public function run(){
        $checkResponse = new CheckResponse();
        $checkResponse->setName(get_class($this));
        $checkTimeStart = microtime(true);

        try {
            $validator = new RequirementValidator($this->requirements, $this->options);
            $validator->validate();
            $checkReturn = $this->check();
            $checkResponse->setStatus(CheckResponse::STATUS_SUCCESS);
        }
        catch(\Exception $e){
            $checkResponse->setStatus(CheckResponse::STATUS_FAILED);
            $checkResponse->setMessage($e->getMessage());
        }

        $checkResponse->setResponseTime(microtime(true) - $checkTimeStart);
        $this->createResponse($checkResponse, isset($checkReturn)?$checkResponse:null);

        return $checkResponse;
    }

    /**
     * @param CheckResponse $response
     * @param $checkReturn
     */
    protected function createResponse(CheckResponse $response, $checkReturn){

    }

    abstract protected function check();
}