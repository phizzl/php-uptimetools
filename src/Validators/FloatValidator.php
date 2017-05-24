<?php


namespace Phizzl\UptimeTools\Validators;


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