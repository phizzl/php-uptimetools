PHP uptime tools
================

This library should help to provide information about uptimes of network services with PHP.

## Checks
There are different kind of checks implemented.
### HTTP(S) keyword
This checks requests a given HTTP(S) resource and checks it for a list of keywords. Since it checks the plain any return value can be checked.

```php
use Phizzl\UptimeTools\Checks\CheckFactory;

$checkFactory = new CheckFactory();
$check = $checkFactory->create(CheckFactory::TYPE_HTTPKEYWORDS, [
    'host' => 'https://www.heise.de',
    'keywords' => ['heise online Themen', 'heise Security', '</html>']
]);
```

### Ping checks
Ping check is sending one ping to a given host.
```php
use Phizzl\UptimeTools\Checks\CheckFactory;

$checkFactory = new CheckFactory();
$check = $checkFactory->create(CheckFactory::TYPE_PING, [
    'host' => 'www.gitub.com'
]);
```

### TCP port check
You may check wether a given TCP port is open on a defined host or not.

```php
use Phizzl\UptimeTools\Checks\CheckFactory;

$checkFactory = new CheckFactory();
$check = $checkFactory->create(CheckFactory::TYPE_TCP, [
    'host' => 'www.github.com',
    'port' => 80
]);
```

## Buckets
To execute the checks they need to added to a bucket. A bucket can euqal your application. For example a Webserver. You may want to test if it's pingable, the TCP port 80 is open and you find the closing HTML tag on your index.

```php
use Phizzl\UptimeTools\Buckets\Bucket;
use Phizzl\UptimeTools\Buckets\DispatchedBucket;
use Phizzl\UptimeTools\Checks\CheckFactory;
use Phizzl\UptimeTools\Checks\DispatchedCheck;

$bucket = new Bucket();
$checkFactory = new CheckFactory();

$bucket->getChecks()->addCheck($checkFactory->create(CheckFactory::TYPE_TCP, [
    'host' => 'www.mywebsite.local',
    'port' => 80
]));

$bucket->getChecks()->addCheck($checkFactory->create(CheckFactory::TYPE_HTTPKEYWORDS, [
    'host' => 'http://www.mywebsite.local',
    'keywords' => ['</html>']
]));

$bucket->getChecks()->addCheck($checkFactory->create(CheckFactory::TYPE_PING, [
    'host' => 'www.mywebsite.local'
]));

$dispatchedBucket = $bucket->run();

echo "Checks took {$dispatchedBucket->getDispatchTime()}s\n";
echo "--------------------------------------\n";
/* @var DispatchedCheck $dispatchedCheck */
foreach($dispatchedBucket->getSucceededDispatchedChecks() as $dispatchedCheck){
    echo "Success: " . get_class($dispatchedCheck->getContext()->getCheck()) . PHP_EOL;
    echo "Executed in: {$dispatchedCheck->getDispatchTime()}s\n";
    echo "--------------------------------------\n";
}

/* @var DispatchedCheck $dispatchedCheck */
foreach($dispatchedBucket->getFailedDispatchedChecks() as $dispatchedCheck){
    echo "Failed: " . get_class($dispatchedCheck->getContext()->getCheck()) . PHP_EOL;
    echo "Executed in: {$dispatchedCheck->getDispatchTime()}s\n";
    echo "Message: {$dispatchedCheck->getMessage()}\n";
    echo "--------------------------------------\n";
}

if($dispatchedBucket->getStatus() === DispatchedBucket::STATUS_SUCCESS){
    echo "All checks passed!\n";
    exit(0);
}
else{
    echo "Error occured!\n";
    exit(1);
}
```