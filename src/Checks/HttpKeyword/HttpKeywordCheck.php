<?php


namespace Phizzl\HeartbeatTools\Checks\HttpKeyword;


use Phizzl\HeartbeatTools\Checks\AbstractCheck;
use Phizzl\HeartbeatTools\Checks\CheckException;
use Phizzl\HeartbeatTools\Checks\Requirements\Requirement;

class HttpKeywordCheck extends AbstractCheck
{
    private $factory;

    public function __construct(){
        parent::__construct();
        $this->factory = new HttpRequestFactory();

        $this->requirements->addRequirement(new Requirement("host", Requirement::TYPE_NOTEMPTY));
        $this->requirements->addRequirement(new Requirement("host", Requirement::TYPE_STRING));
        $this->requirements->addRequirement(new Requirement("keywords", Requirement::TYPE_NOTEMPTY));
        $this->requirements->addRequirement(new Requirement("keywords", Requirement::TYPE_ARRAY));

        $this->options->set('keywords', []);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws CheckException
     */
    public function run(){
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
}