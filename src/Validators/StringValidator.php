<?php


namespace Phizzl\HeartbeatTools\Validators;


class FloatValidator implements TypeValidatorInterface
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value){
        return is_float($value);
    }
}