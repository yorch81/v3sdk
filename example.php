<?php
	require 'V3Sdk.class.php';

	$v3 = V3Sdk::getInstance('http://v3ctorwh.localhost/', "lYltuNtYYbYRFC7QWwHn9b5aH2UJMk1234567890");

	if ($v3->isConnected()){
		$data = array('DATA' => 111, 'NAME' => 'japt');

		$result = $v3->newObject('v3', $data);

		$_id = V3Sdk::getId($result['_id']);

		$data = array('DATA' => 111, 'NAME' => 'yorch');

		$result = $v3->updateObject('v3', $_id, $data);
		var_dump($result);

		$result = $v3->findObject('v3', $_id);
		var_dump($result);

		$result = $v3->query('v3', $data);
		var_dump($result);

		foreach ($result as $item) {
			echo V3Sdk::getId($item->_id) . "\n";
		}

		$result = $v3->deleteObject('v3', $_id);
	}
		
?>