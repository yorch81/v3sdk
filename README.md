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
        "yorch/v3sdk" : "dev-master"
    }
}

~~~

Execute composer.phar install

## Example ##
~~~

// Get Instance
$v3 = V3Sdk::getInstance('http://v3-japt.rhcloud.com/', "lYltuNtYYbYRFC7QWwHn9b5aH2UJMk1234567890");

// Check if Connected
if ($v3->isConnected()){	
	$data = array('DATA' => 111, 'NAME' => 'jorge');

	// Insert new Object
	$result = $v3->newObject('v3', $data);
	var_dump($result);

	// Get Id
	$_id = V3Sdk::getId($result['_id']);

	// Get Id for MySQL Case
	//$_id = $result[0]->_id;

	// Update Object
	$data = array('DATA' => 111, 'NAME' => 'yorch');
	$result = $v3->updateObject('v3', $_id, $data);

	// Find By Id
	$result = $v3->findObject('v3', $_id);
	var_dump($result);

	// Find By Pattern
	$result = $v3->query('v3', $data);
	var_dump($result);

	// Foreach Result
	foreach ($result as $item) {
		echo V3Sdk::getId($item->_id) . "\n";
	}
	
	// Delete Object
	$result = $v3->deleteObject('v3', $_id);
}

~~~

## Notes ##
V3Sdk PHP uses CURL for access to V3ctor WareHouse.

## References ##
http://es.wikipedia.org/wiki/Singleton

P.D. Let's go play !!!




