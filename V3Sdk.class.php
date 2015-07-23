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
     * Connected Flag
     * 
     * @var string $_connected Connected Flag
     *
     * @access private
     */
	private $_connected = false;

	/**
	 * CURL Resource
	 * 
	 * @var resource $_curl CURL
	 */
	private $_curl; 

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

		if (!extension_loaded('curl')) {
            die("CURL PHP Module not loaded !!!");
        }

		$this->_connected = $this->welcome();
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
			self::$_instance = new $class($v3Url, $v3Key);
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
	 * Check if is Connected
	 * 
	 * @return boolean
	 */
	public function isConnected()
	{
		return $this->_connected;
	}

	/**
	 * Init CURL Resource
	 * 
	 * @param  string $url URL
	 */
	private function curl_init($url)
	{
		$this->_curl = curl_init($url);

		curl_setopt($this->_curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2");  
        curl_setopt($this->_curl, CURLOPT_HEADER, false);  
        curl_setopt($this->_curl, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en"));  
        curl_setopt($this->_curl, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($this->_curl, CURLOPT_SSL_VERIFYHOST, false);  
        curl_setopt($this->_curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);  
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($this->_curl, CURLOPT_CONNECTTIMEOUT, 5);  
        curl_setopt($this->_curl, CURLOPT_TIMEOUT, 60);  
        curl_setopt($this->_curl, CURLOPT_AUTOREFERER, TRUE);
	}

	/**
	 * Close CURL Resource
	 */
	private function curl_close()
	{
		curl_close($this->_curl);
	}

	/**
	 * Check URL
	 * 
	 * @return boolean
	 */
	private function welcome()
	{
		$retValue = true;

		// Init CURL
		$this->curl_init($this->_url);

		curl_setopt($this->_curl, CURLOPT_URL, $this->_url);
		curl_setopt($this->_curl, CURLOPT_POST, false); 

		$response = curl_exec ($this->_curl);  
		
		// Close CURL
		$this->curl_close();

		if($response === false)
			$retValue = false;
		else{
			if ($this->isError($response))
		    	$retValue = false;
		}

		return ($retValue);
	}

	/**
	 * Evaluate if response is Error
	 * 
	 * @param  string  $response V3ctor WareHouse Response
	 * @return boolean           
	 */
	private function isError($response)
	{
		if (substr($response, 0, 7) == '{"error')
			return true;
		else
			return false;
	}

	/**
	 * Gets a ID String
	 * @param  object $_id Object Id
	 * @return string      String Id
	 */
	public static function getId($_id)
	{
		$retValue = '';

		if (gettype($_id) == 'object'){
			$arrayId = (array) $_id;

			$retValue = $arrayId['$id'];
		}
		elseif (gettype($_id) == 'array') {
			$retValue = $_id['$id'];
		}

		return $retValue;
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
		$retValue = array();
		$url = $this->_url . $entity . '/' . $_id . '?auth=' . $this->_key;

		// Init CURL
		$this->curl_init($url);

		curl_setopt($this->_curl, CURLOPT_URL, $url);
		curl_setopt($this->_curl, CURLOPT_POST, false); 

		$response = curl_exec ($this->_curl);  
		
		// Close CURL
		$this->curl_close();

		if($response === false)
			$retValue = array();
		else{
			if (! $this->isError($response))
		    	$retValue = (array) json_decode($response);	
		}

		return $retValue;
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
		$retValue = array();
		$url = $this->_url . 'query/' . $entity . '?auth=' . $this->_key;

		$jsonQuery = json_encode($query);
		
		// Init CURL
		$this->curl_init($url);

		curl_setopt($this->_curl, CURLOPT_URL, $url);
        curl_setopt($this->_curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $jsonQuery);                                                                    
		curl_setopt($this->_curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($jsonQuery))); 

		$response = curl_exec ($this->_curl);  
		
		// Close CURL
		$this->curl_close();

		if($response === false)
			$retValue = array();
		else{
			if (! $this->isError($response))
		    	$retValue = (array) json_decode($response);	
		}

		return $retValue;
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
		$retValue = array();
		$url = $this->_url . $entity . '?auth=' . $this->_key;

		$jsonData = json_encode($jsonObject);

		// Init CURL
		$this->curl_init($url);

		curl_setopt($this->_curl, CURLOPT_URL, $url);
        curl_setopt($this->_curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $jsonData);                                                                    
		curl_setopt($this->_curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($jsonData))); 

		$response = curl_exec ($this->_curl); 

		// Close CURL
		$this->curl_close();

		if($response === false)
			$retValue = array();
		else{
			if (! $this->isError($response))
		    	$retValue = (array) json_decode($response);	
		}

		return $retValue;
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
		$url = $this->_url . $entity . '/' . $_id . '?auth=' . $this->_key;

		$jsonData = json_encode($jsonObject);

		// Init CURL
		$this->curl_init($url);

		curl_setopt($this->_curl, CURLOPT_URL, $url);
        curl_setopt($this->_curl, CURLOPT_CUSTOMREQUEST, "PUT");                                                                     
		curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $jsonData);                                                                    
		curl_setopt($this->_curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($jsonData))); 

		$response = curl_exec ($this->_curl); 

		// Close CURL
		$this->curl_close();

		if($response === false)
			return false;
		else{
			if (! $this->isError($response))
		    	return true;
		   	else
		   		return false;
		}
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
		$url = $this->_url . $entity . '/' . $_id . '?auth=' . $this->_key;

		// Init CURL
		$this->curl_init($url);

		curl_setopt($this->_curl, CURLOPT_URL, $url);
		curl_setopt($this->_curl, CURLOPT_CUSTOMREQUEST, 'DELETE');

		$response = curl_exec ($this->_curl); 

		// Close CURL
		$this->curl_close();

		if($response === false)
			return false;
		else{
			if (! $this->isError($response))
		    	return true;
		   	else
		   		return false;
		}
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