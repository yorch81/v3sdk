<?php
	require 'vendor/autoload.php';

	$v3 = V3Sdk::getInstance('http://v3-japt.rhcloud.com/', "lYltuNtYYbYRFC7QWwHn9b5aH2UJMk1234567890");

	if ($v3->isConnected())
		echo "Welcome !!!\n"
?>