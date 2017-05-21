<?php


namespace Phizzl\HeartbeatTools\Validators;


interface TypeValidatorInterface
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value);
}