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
     * @param null|mixed $default
     * @return mixed
     */
    public function get($name, $default = null){
        return $this->has($name) ? $this->options[$name] : $default;
    }

    /**
     * @return array
     */
    public function all(){
        return $this->options;
    }
}