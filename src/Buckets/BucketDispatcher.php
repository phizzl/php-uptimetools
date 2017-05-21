<?php

namespace Phizzl\HeartbeatTools\Buckets;


class BucketDispatcher
{
    /**
     * @var BucketValidator
     */
    private $bucketValidator;

    /**
     * @var BucketCheckDispatcher
     */
    private $checkDispatcher;

    public function __construct(){
        $this->bucketValidator = new BucketValidator();
        $this->checkDispatcher = new BucketCheckDispatcher();
    }

    /**
     * @param BucketValidator $bucketValidator
     */
    public function setBucketValidator(BucketValidator $bucketValidator){
        $this->bucketValidator = $bucketValidator;
    }

    /**
     * @param BucketCheckDispatcher $checkDispatcher
     */
    public function setCheckDispatcher(BucketCheckDispatcher $checkDispatcher){
        $this->checkDispatcher = $checkDispatcher;
    }

    public function dispatch(Bucket $bucket){
        $this->bucketValidator->validate($bucket);
        $this->checkDispatcher->dispatch($bucket->getChecks());
    }

}