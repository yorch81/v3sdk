<?php
require_once('vendor/autoload.php');

/**
 * V3SdkTest
 * 
 * V3SdkTest Test Example
 *
 * Copyright 2015 Jorge Alberto Ponce Turrubiates
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @category   V3SdkTest
 * @package    V3SdkTest
 * @copyright  Copyright 2015 Jorge Alberto Ponce Turrubiates
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    1.0.0, 2015-07-22
 * @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)
 */
class V3SdkTest extends PHPUnit_Framework_TestCase
{
    protected $v3ctor;

    /**
     * Setup Test
     */
    protected function setUp() {
        $url = 'http://v3-japt.rhcloud.com/';
        $key = "lYltuNtYYbYRFC7QWwHn9b5aH2UJMk1234567890";

    	$this->v3ctor = V3Sdk::getInstance($url, $key);
    }

    /**
     * TearDown Test
     */
    protected function tearDown() {
        unset($this->v3ctor);
    }

    /**
     * Test Is Connected
     */
    public function testIsConnected() {
        $expected = "";

        if ($this->v3ctor->isConnected())
        	$expected = "OK";

        $this->assertEquals($expected, "OK");
    }

}
?>