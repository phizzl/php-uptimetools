<?php

namespace Phizzl\HeartbeatTools\Options\Requirements;


use Phizzl\HeartbeatTools\Checks\Options;
use Phizzl\HeartbeatTools\Validators\ValidatorFactory;

class Requirement
{
    /**
     * @var string
     */
    private $optionName;

    /**
     * @var string
     */
    private $type;

    /**
     * @var ValidatorFactory
     */
    private $validatorFactory;

    public function __construct($optionName, $type){
        $this->setOptionName($optionName);
        $this->setType($type);
        $this->validatorFactory = new ValidatorFactory();
    }

    /**
     * @param string $optionName
     */
    public function setOptionName($optionName){
        $this->optionName = (string)$optionName;
    }

    /**
     * @param string $type
     */
    public function setType($type){
        $this->type = (string)$type;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function requirementsMet(Options $options){
        $validator = $this->validatorFactory->create($this->type);
        return $validator->isValid($options->get($this->optionName));
    }
}