<?php

namespace Phizzl\HeartbeatTools\Checks;


class RequirementValidator
{
    /**
     * @var CheckRequirements
     */
    private $requirements;

    /**
     * @var Options
     */
    private $options;

    /**
     * RequirementValidator constructor.
     * @param CheckRequirements $requirements
     * @param Options $options
     */
    public function __construct(CheckRequirements $requirements, Options $options){
        $this->requirements = $requirements;
        $this->options = $options;
    }

    public function validate(){
        foreach($this->requirements->getRequiredOptions() as $reqOption){
            if(!$this->options->has($reqOption)){
                throw new \InvalidArgumentException("A required option has not been set {$reqOption}");
            }

            $requiredValueType = $this->requirements->getRequiredOptionType($reqOption);
            if(!$this->validateType($this->options->get($reqOption), $requiredValueType)){
                throw new \InvalidArgumentException("Invalid type for {$reqOption}. Must be {$requiredValueType}");
            }
        }
    }

    /**
     * @param mixed $value
     * @param string $type
     * @return bool
     */
    private function validateType($value, $type){
        switch($type){
            case CheckRequirements::TYPE_STRING: return is_string($value);
            case CheckRequirements::TYPE_FLOAT: return is_float($value);
            case CheckRequirements::TYPE_INT: return is_int($value);
            case CheckRequirements::TYPE_ARRAY: return is_array($value);
        }

        return false;
    }
}