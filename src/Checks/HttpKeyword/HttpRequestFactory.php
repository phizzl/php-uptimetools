<?php


namespace Phizzl\HeartbeatTools\Checks\HttpKeyword;


use Phizzl\HeartbeatTools\Checks\Options;
use Phizzl\NetworkTools\Http\HttpHeader;
use Phizzl\NetworkTools\Http\HttpOptions;
use Phizzl\NetworkTools\Http\HttpRequest;

class HttpRequestFactory
{
    /**
     * @param Options $options
     * @return HttpRequest
     */
    public function create(Options $options){
        $httpHeader = new HttpHeader();
        $httpOptions = new HttpOptions();
        $httpRequest = new HttpRequest();
        $httpRequest->setHost($options->get('host'));

        if($options->has('timeout')){
            $httpOptions->setTimeout($options->get('timeout'));
        }

        if($options->has('username')){
            $httpOptions->setUsername($options->get('username'));
        }

        if($options->has('password')){
            $httpOptions->setPassword($options->get('password'));
        }

        if($options->has('allow_redirects')){
            $httpOptions->setAllowRedirects($options->get('allow_redirects'));
        }

        if($options->has('headers')
            && is_array($options->get('headers'))){
            foreach($options->get('headers') as $name => $value){
                $httpHeader->set($name, $value);
            }
        }

        $httpRequest->setHeader($httpHeader);
        $httpRequest->setOptions($httpOptions);

        return $httpRequest;
    }
}