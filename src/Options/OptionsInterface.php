<?php


namespace Phizzl\HeartbeatTools\Options;


interface OptionsInterface
{


    /**
     * @param string $name
     * @param mixed $value
     */
    public function set($name, $value);

    /**
     * @param string $name
     * @return bool
     */
    public function has($name);

    /**
     * @param string $name
     * @param null|mixed $default
     * @return mixed
     */
    public function get($name, $default = null);

    /**
     * @return array
     */
    public function all();
}