<?php


namespace Phizzl\HeartbeatTools\Checks\HttpKeyword;


use Phizzl\HeartbeatTools\Checks\AbstractCheck;
use Phizzl\HeartbeatTools\Checks\CheckException;
use Phizzl\HeartbeatTools\Checks\CheckRequirements;
use Phizzl\HeartbeatTools\Checks\CheckResponse;
use Psr\Http\Message\ResponseInterface;

class HttpKeywordCheck extends AbstractCheck
{
    private $factory;

    public function __construct(){
        parent::__construct();
        $this->factory = new HttpRequestFactory();

        $this->requirements->addRequiredOption("host", CheckRequirements::TYPE_STRING);
        $this->requirements->addRequiredOption("keywords", CheckRequirements::TYPE_ARRAY);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws CheckException
     */
    protected function check(){
        $request = $this->factory->create($this->options);
        $response = $request->send();

        if( $response->getStatusCode() !== 200 ){
            throw new CheckException("Bad HTTP response Code: " . $response->getStatusCode());
        }

        $contents = $response->getBody()->getContents();
        foreach($this->options->get('keywords') as $keyword){
            if(strpos($contents, $keyword) === false){
                throw new CheckException("Keyword \"{$keyword}\" could not be found");
            }
        }

        return $response;
    }

    /**
     * @param CheckResponse $response
     * @param $checkReturn
     */
    protected function createResponse(CheckResponse $response, $checkReturn){
        if(!$checkReturn instanceof ResponseInterface){
            return;
        }

        $response->setMessage("OK");
    }
}