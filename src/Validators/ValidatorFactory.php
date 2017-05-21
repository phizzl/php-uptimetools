<?php


namespace Phizzl\HeartbeatTools\Validators;


class ValidatorFactory
{
    const TYPE_ARRAY = "array";

    const TYPE_FLOAT = "float";

    const TYPE_INTEGER = "int";

    const TYPE_STRING = "string";

    const TYPE_NOTEMPTY = "notempty";

    /**
     * @param string $type
     * @return TypeValidatorInterface
     */
    public function create($type){
        switch($type){
            case self::TYPE_ARRAY: $validator = new ArrayValidator(); break;
            case self::TYPE_FLOAT: $validator = new FloatValidator(); break;
            case self::TYPE_INTEGER: $validator = new IntegerValidator(); break;
            case self::TYPE_STRING: $validator = new StringValidator(); break;
            case self::TYPE_NOTEMPTY: $validator = new NotEmptyValidator(); break;
            default: throw new \InvalidArgumentException("Type \"$type\" is not supported");
        }

        return $validator;
    }
}