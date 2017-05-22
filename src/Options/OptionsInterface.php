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
     * @return mixed
     */
    public function get($name);

    /**
     * @return array
     */
    public function all();
}