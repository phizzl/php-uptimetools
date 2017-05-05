<?php

use Phizzl\HeartbeatTools\CheckBucket;
use Phizzl\HeartbeatTools\Checks\CheckResponse;
use Phizzl\HeartbeatTools\Checks\HttpKeywordCheck;
use Phizzl\HeartbeatTools\Checks\Options;
use Phizzl\HeartbeatTools\Checks\PingCheck;
use Phizzl\HeartbeatTools\Checks\TcpPortCheck;

require_once __DIR__ . '/vendor/autoload.php';

$bucket = new CheckBucket();
$bucket->setName("Heise Website");

$options = new Options();
$options->set('host', 'https://www.heise.de/');
$options->set('keywords', ['heise online Themen', 'Stellenmarkt']);
$httpCheck = new HttpKeywordCheck();
$httpCheck->setOptions($options);
$bucket->addCheck($httpCheck);

$options = new Options();
$options->set('host', 'www.heise.de');
$pingCheck = new PingCheck();
$pingCheck->setOptions($options);
$bucket->addCheck($pingCheck);

$options = new Options();
$options->set('host', 'www.heise.de');
$options->set('port', 80);
$tcpCheck = new TcpPortCheck();
$tcpCheck->setOptions($options);
$bucket->addCheck($tcpCheck);

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