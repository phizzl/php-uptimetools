<?php


namespace Phizzl\HeartbeatTools\Validators;


class NotEmptyValidator implements TypeValidatorInterface
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value){
        return is_array($value) ? count($value) > 0 : !empty($value);
    }
}