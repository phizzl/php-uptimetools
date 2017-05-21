<?php


namespace Phizzl\HeartbeatTools\Checks;


use Phizzl\HeartbeatTools\Checks\HttpKeyword\HttpKeywordCheck;
use Phizzl\HeartbeatTools\Checks\Ping\PingCheck;
use Phizzl\HeartbeatTools\Checks\Tcp\TcpPortCheck;

class CheckFactory
{
    const TYPE_HTTPKEYWORDS = "httpkeywords";

    const TYPE_PING = "ping";

    const TYPE_TCP = "tcp";

    /**
     * @param string $type
     * @param Options $options
     * @return CheckInterface
     */
    public function create($type, Options $options){
        switch($type){
            case self::TYPE_HTTPKEYWORDS: $check = new HttpKeywordCheck(); break;
            case self::TYPE_PING: $check = new PingCheck(); break;
            case self::TYPE_TCP: $check = new TcpPortCheck(); break;
            default: throw new \InvalidArgumentException("Type \"$type\" is not supported");
        }

        $check->setOptions($options);

        return $check;
    }
}