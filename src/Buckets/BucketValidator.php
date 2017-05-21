<?php


namespace Phizzl\HeartbeatTools\Buckets;


use Phizzl\HeartbeatTools\Validators\ValidatorFactory;

class BucketValidator
{
    /**
     * @var ValidatorFactory
     */
    private $validatorFactory;

    public function __construct(){
        $this->validatorFactory = new ValidatorFactory();
    }

    /**
     * @param Bucket $bucket
     * @return bool
     */
    public function validate(Bucket $bucket){
        $validator = $this->validatorFactory->create(ValidatorFactory::TYPE_REQUIREMENTS);
        foreach($bucket->getChecks()->all() as $check){
            $validator->isValid($check);
        }

        return true;
    }
}