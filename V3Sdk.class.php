<?php

/**
 * V3Sdk 
 *
 * V3Sdk V3ctor WareHouse PHP SDK
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
 * @category   V3Sdk
 * @package    V3Sdk
 * @copyright  Copyright 2015 Jorge Alberto Ponce Turrubiates
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    1.0.0, 2015-07-22
 * @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)
 */
class V3Sdk
{
	/**
     * Instance Handler to Singleton Pattern
     *
     * @var object $_instance Instance Handler
     * @access private
     */
	private static $_instance;

	/**
     * V3ctor URL
     * 
     * @var string $_url V3ctor WH URL
     *
     * @access private
     */
	private $_url;


	/**
     * V3ctor Key
     * 
     * @var string $_key V3ctor WH Key
     *
     * @access private
     */
	private $_key;

	/**
	 * Constructor of class
	 * 
	 * @param string $v3Url    V3ctor URL
	 * @param string $v3Key    V3ctor Private Key
	 */
	private function __construct($v3Url, $v3Key)
	{
		$this->_url = $v3Url;
		$this->_key = $v3Key;
	}

	/**
	 * Singleton Implementation
	 * 
	 * @param string $v3Url    V3ctor URL
	 * @param string $v3Key    V3ctor Private Key
	 * @return resource | null
	 */
	public static function getInstance($v3Url = '', $v3Key = '')
	{
		// If exists Instance return same Instance
		if(self::$_instance){
			return self::$_instance;
		}
		else{
			$class = __CLASS__;
			self::$_instance = new $class($v3Url, $v3Url);
			return self::$_instance;
		}
	}

	/**
	 * Gets URL
	 * 
	 * @return string URL
	 */
	public function getUrl()
	{
		return $this->_url;
	}

	/**
	 * Gets Key
	 * 
	 * @return string Key
	 */
	public function getKey()
	{
		return $this->_key;
	}

	/**
	 * Check URL
	 * 
	 * @return boolean
	 */
	private function welcome()
	{
		$handler = curl_init($this->_url); 
		curl_setopt($handler, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2");  
        curl_setopt($handler, CURLOPT_HEADER, false);  
        curl_setopt($handler, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en"));  
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, false);  
        curl_setopt($handler, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);  
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_CONNECTTIMEOUT, 5);  
        curl_setopt($handler, CURLOPT_TIMEOUT, 60);  
        curl_setopt($handler, CURLOPT_AUTOREFERER, TRUE);  
		curl_exec ($handler); 

		$code = curl_getinfo($handler, CURLINFO_HTTP_CODE);

		curl_close($handler);  

		return $code==200?true:false;
	}

	/**
	 * Find Object by _id
	 *
	 * @param  string $entity Entity
	 * @param  string $_id 	  Identificator of Object
	 * @return array Object
	 */
	public function findObject($entity, $_id)
	{
		return $entity;
	}

	/**
	 * Find by Pattern (Query)
	 *
	 * @param  string $entity Entity
	 * @param  array  $query  Query Pattern
	 * @return array Object
	 */
	public function query($entity, $query)
	{
		return $entity;
	}

	/**
	 * Create New Object
	 *
	 * @param  string $entity    Entity
	 * @param  array $jsonObject Json Object to Insert
	 * @return array Inserted Object
	 */
	public function newObject($entity, $jsonObject)
	{
		return $entity;
	}

	/**
	 * Update a Object by _id
	 *
	 * @param  string $entity    Entity
	 * @param  string $_id       Identificator of Object
	 * @param  array $jsonObject New Json Object
	 * @return boolean
	 */
	public function updateObject($entity, $_id, $jsonObject)
	{
		return true;
	}

	/**
	 * Delete Object by _id
	 *
	 * @param  string $entity Entity
	 * @param  string $_id    Identificator of Object
	 * @return boolean
	 */
	public function deleteObject($entity, $_id)
	{
		return true;
	}

	/**
	 * Create Entity
	 * 
	 * @param  string $entityName Name of Entity
	 * @param  array  $jsonConfig Json Configuration
	 * @return boolean
	 */
	public function createEntity($entityName, $jsonConfig)
	{
		// Not Implemented
		return false;
	}
}
?>