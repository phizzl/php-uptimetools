<?php


namespace Phizzl\UptimeTools\Checks;


use Phizzl\UptimeTools\Checks\HttpKeyword\HttpKeywordCheck;
use Phizzl\UptimeTools\Checks\Ping\PingCheck;
use Phizzl\UptimeTools\Checks\Tcp\TcpPortCheck;
use Phizzl\UptimeTools\Options\Options;

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