<?php

namespace Phizzl\UptimeTools\Dispatcher;




use Phizzl\UptimeTools\Buckets\Bucket;
use Phizzl\UptimeTools\Buckets\DispatchedBucket;
use Phizzl\UptimeTools\Validators\BucketValidator;

class BucketDispatcher
{
    /**
     * @var BucketValidator
     */
    private $bucketValidator;

    /**
     * @var CheckDispatcher
     */
    private $checkDispatcher;

    public function __construct(){
        $this->bucketValidator = new BucketValidator();
        $this->checkDispatcher = new CheckDispatcher();
    }

    /**
     * @param BucketValidator $bucketValidator
     */
    public function setBucketValidator(BucketValidator $bucketValidator){
        $this->bucketValidator = $bucketValidator;
    }

    /**
     * @param CheckDispatcher $checkDispatcher
     */
    public function setCheckDispatcher(CheckDispatcher $checkDispatcher){
        $this->checkDispatcher = $checkDispatcher;
    }

    /**
     * @param Bucket $bucket
     * @return DispatchedBucket
     */
    public function dispatch(Bucket $bucket){
        $this->bucketValidator->validate($bucket);
        $dispatchedBucket = new DispatchedBucket();
        $dispatchedChecks = $this->checkDispatcher->dispatch($bucket->getChecks());

        $dispatchedBucket->setDispatchedChecks($dispatchedChecks);

        return $dispatchedBucket;
    }

}