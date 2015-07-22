<?php
	require_once('V3Sdk.class.php');

	$v3 = V3Sdk::getInstance('http://v3-japt.rhcloud.com/', "lYltuNtYYbYRFC7QWwHn9b5aH2UJMk1234567890");

	echo $v3->getUrl();
?>