<?php

use Phizzl\HeartbeatTools\Buckets\Bucket;
use Phizzl\HeartbeatTools\Buckets\DispatchedBucket;
use Phizzl\HeartbeatTools\Checks\CheckFactory;
use Phizzl\HeartbeatTools\Checks\DispatchedCheck;

require_once __DIR__ . '/vendor/autoload.php';

$bucket = new Bucket();
$checkFactory = new CheckFactory();

$bucket->getChecks()->addCheck($checkFactory->create(CheckFactory::TYPE_TCP, [
    'host' => 'www.heise.de',
    'port' => 80
]));

$bucket->getChecks()->addCheck($checkFactory->create(CheckFactory::TYPE_HTTPKEYWORDS, [
    'host' => 'https://www.heise.de',
    'keywords' => ['heise online Themen', 'heise Security', '</html>']
]));

$bucket->getChecks()->addCheck($checkFactory->create(CheckFactory::TYPE_PING, [
    'host' => 'www.heise.de'
]));

$dispatchedBucket = $bucket->run();

echo "Checks took {$dispatchedBucket->getDispatchedChecks()}s\n";
/* @var DispatchedCheck $dispatchedCheck */
foreach($dispatchedBucket->getSucceededDispatchedChecks() as $dispatchedCheck){
    echo "Success: " . get_class($dispatchedCheck->getContext()->getCheck()) . PHP_EOL;
    echo "Executed in: {$dispatchedCheck->getDispatchTime()}s\n";
}

/* @var DispatchedCheck $dispatchedCheck */
foreach($dispatchedBucket->getFailedDispatchedChecks() as $dispatchedCheck){
    echo "Failed: " . get_class($dispatchedCheck->getContext()->getCheck()) . PHP_EOL;
    echo "Executed in: {$dispatchedCheck->getDispatchTime()}s\n";
    echo "Message: {$dispatchedCheck->getMessage()}\n";
}

if($dispatchedBucket->getStatus() === DispatchedBucket::STATUS_SUCCESS){
    echo "All checks passed!\n";
    exit(0);
}
else{
    echo "Error occured!\n";
    exit(1);
}

