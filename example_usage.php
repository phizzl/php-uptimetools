<?php

use Phizzl\HeartbeatTools\CheckBucket;
use Phizzl\HeartbeatTools\Checks\CheckFactory;
use Phizzl\HeartbeatTools\Checks\CheckResponse;
use Phizzl\HeartbeatTools\Checks\Options;

require_once __DIR__ . '/vendor/autoload.php';

$bucket = new CheckBucket();
$bucket->setName("Heise Website");
$checkFactory = new CheckFactory();

//$options = new Options();
//$options->set('host', 'https://www.heise.de/');
//$options->set('keywords', ['heise online Themen', 'Stellenmarkt']);
//$bucket->addCheck($checkFactory->create(CheckFactory::TYPE_HTTPKEYWORDS, $options));

//$options = new Options();
//$options->set('host', 'www.heise.de');
//$bucket->addCheck($checkFactory->create(CheckFactory::TYPE_PING, $options));

$options = new Options();
$options->set('host', 'www.heise.de');
$options->set('port', 80);
$bucket->addCheck($checkFactory->create(CheckFactory::TYPE_TCP, $options));

$status = $bucket->run();

echo '<pre>';
if(!$status->isOk()){
    echo "{$bucket->getName()} did not pass all tests\n";
    /* @var CheckResponse $checkResponse */
    foreach($status->getFailedChecks() as $checkResponse){
        echo "{$checkResponse->getName()}:  {$checkResponse->getMessage()}\n";
    }
}
else{
    echo "Everything ok!";
}