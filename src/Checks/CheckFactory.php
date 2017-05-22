<?php


namespace Phizzl\HeartbeatTools\Checks;


use Phizzl\HeartbeatTools\Checks\HttpKeyword\HttpKeywordCheck;
use Phizzl\HeartbeatTools\Checks\Ping\PingCheck;
use Phizzl\HeartbeatTools\Checks\Tcp\TcpPortCheck;
use Phizzl\HeartbeatTools\Options\Options;

class CheckFactory
{
    const TYPE_HTTPKEYWORDS = "httpkeywords";

    const TYPE_PING = "ping";

    const TYPE_TCP = "tcp";

    /**
     * @param string $type
     * @param array $parameter
     * @return CheckInterface
     */
    public function create($type, array $parameter){
        switch($type){
            case self::TYPE_HTTPKEYWORDS: $check = new HttpKeywordCheck(); break;
            case self::TYPE_PING: $check = new PingCheck(); break;
            case self::TYPE_TCP: $check = new TcpPortCheck(); break;
            default: throw new \InvalidArgumentException("Type \"$type\" is not supported");
        }

        $options = $check->getOptions() ? $check->getOptions() : new Options();
        foreach($parameter as $name => $value){
            $options->set($name, $value);
        }

        $check->setOptions($options);

        return $check;
    }
}