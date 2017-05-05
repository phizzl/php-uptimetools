<?php


namespace Phizzl\HeartbeatTools\Checks;


use Phizzl\NetworkTools\Http\HttpHeader;
use Phizzl\NetworkTools\Http\HttpOptions;
use Phizzl\NetworkTools\Http\HttpRequest;
use Psr\Http\Message\ResponseInterface;

class HttpKeywordCheck extends AbstractCheck
{
    public function __construct(){
        parent::__construct();

        $this->requirements->addRequiredOption("host", CheckRequirements::TYPE_STRING);
        $this->requirements->addRequiredOption("keywords", CheckRequirements::TYPE_ARRAY);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws CheckException
     */
    protected function check(){
        $header = new HttpHeader();
        $options = new HttpOptions();
        $request = new HttpRequest();
        $request->setHost($this->options->get('host'));

        if($this->options->has('timeout')){
            $options->setTimeout($this->options->get('timeout'));
        }

        if($this->options->has('username')){
            $options->setUsername($this->options->get('username'));
        }

        if($this->options->has('password')){
            $options->setPassword($this->options->get('password'));
        }

        if($this->options->has('allow_redirects')){
            $options->setAllowRedirects($this->options->get('allow_redirects'));
        }

        if($this->options->has('headers')
            && is_array($this->options->get('headers'))){
            foreach($this->options->get('headers') as $name => $value){
                $header->set($name, $value);
            }
        }

        $request->setHeader($header);
        $request->setOptions($options);

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