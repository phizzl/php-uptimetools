<?php

namespace Phizzl\HeartbeatTools\Checks;


class CheckRequirements
{
    const TYPE_STRING = "string";

    const TYPE_ARRAY = "array";

    const TYPE_FLOAT = "float";

    const TYPE_INT = "int";

    /**
     * @var array
     */
    private $requiredOptions;

    public function __construct(){
        $this->requiredOptions = [];
    }

    /**
     * @param string name
     * @param string
     */
    public function addRequiredOption($name, $type = "string"){
        $this->requiredOptions[(string)$name] = $type;
    }

    /**
     * @return array
     */
    public function getRequiredOptions(){
        return array_keys($this->requiredOptions);
    }

    /**
     * @param string $name
     * @return string
     */
    public function getRequiredOptionType($name){
        if(!isset($this->requiredOptions[(string)$name])){
            throw new \InvalidArgumentException("{$name} is unknown");
        }

        return $this->requiredOptions[(string)$name];
    }
}