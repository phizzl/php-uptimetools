<?php

namespace Phizzl\UptimeTools\Checks\Requirements;

use Phizzl\UptimeTools\Options\OptionsInterface;
use Phizzl\UptimeTools\Validators\ValidatorFactory;

class Requirement
{
    const TYPE_ARRAY = ValidatorFactory::TYPE_ARRAY;

    const TYPE_FLOAT = ValidatorFactory::TYPE_FLOAT;

    const TYPE_INTEGER = ValidatorFactory::TYPE_INTEGER;

    const TYPE_STRING = ValidatorFactory::TYPE_STRING;

    const TYPE_NOTEMPTY = ValidatorFactory::TYPE_NOTEMPTY;

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
     * @param OptionsInterface $options
     * @return bool
     */
    public function requirementsMet(OptionsInterface $options){
        $validator = $this->validatorFactory->create($this->type);
        return $validator->isValid($options->get($this->optionName));
    }
}