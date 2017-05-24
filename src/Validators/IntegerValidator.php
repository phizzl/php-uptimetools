<?php


namespace Phizzl\UptimeTools\Validators;


class IntegerValidator implements TypeValidatorInterface
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value){
        return is_int($value);
    }
}