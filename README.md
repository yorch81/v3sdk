# V3ctor Sdk #

## Description ##
V3ctor WareHouse PHP Sdk

## Requirements ##
* [PHP 5.4.1 or higher](http://www.php.net/)
* [V3ctor WareHouse](https://github.com/yorch81/v3ctorwh)

## Developer Documentation ##
Execute phpdoc -d v3sdk/

## Unit Test ##
For run Unit Test, complete information connection and execute the next commands:
> phpunit V3SdkTest.php

## Installation ##
Create file composer.json
~~~

{
    "require": {
    	"php": ">=5.4.0",
        "yorch/v3sdk" : "dev-master",
        "curl/curl": "2.0.0-alpha1"
    }
}

~~~

Execute composer.phar install

## Example ##
~~~

$v3 = V3Sdk::getInstance('http://v3-japt.rhcloud.com/', "KEY");

echo $v3->getUrl();

~~~

## Notes ##
V3Sdk PHP uses CURL for access to V3ctor WareHouse.

## References ##
http://es.wikipedia.org/wiki/Singleton

P.D. Let's go play !!!




