<?php


namespace Phizzl\HeartbeatTools\Validators;


class ArrayValidator implements TypeValidatorInterface
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value){
        return is_array($value);
    }
}