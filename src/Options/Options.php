<?php


namespace Phizzl\HeartbeatTools\Options;


class Options implements OptionsInterface
{
    /**
     * @var array
     */
    private $options;

    public function __construct(){
        $this->options = [];
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function set($name, $value){
        $this->options[(string)$name] = $value;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name){
        return isset($this->options[(string)$name]);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name){
        if(!$this->has($name)){
            throw new \InvalidArgumentException("Parameter \"{$name}\" is not set");
        }
        return $this->options[(string)$name];
    }

    /**
     * @return array
     */
    public function all(){
        return $this->options;
    }
}