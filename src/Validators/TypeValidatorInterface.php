<?php


namespace Phizzl\UptimeTools\Validators;


interface TypeValidatorInterface
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value);
}