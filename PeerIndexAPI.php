<?php
/**
 *	A PHP wrapper for the PeerIndex API
 *
 *	@see https://developers.peerindex.com/
 *	@author Iain Mullan <iain.mullan@gmail.com>, @iainmullan
 *	@license MIT <http://opensource.org/licenses/MIT>
 **/
class PeerIndexAPI {

	private $apiKey;
	private $baseUrl = 'http://api.peerindex.com';
	private $version = '1';
	private $format = 'json';

	function __construct($apiKey, $format = 'json') {
		$this->apiKey = $apiKey;

		if (in_array($format, array('json', 'xml'))) {
			$this->format = $format;
		}
	}

	/**
	 *	@see https://developers.peerindex.com/docs/read/1_GET_actor_basic
	 */
	function basic($twitterScreenName) {
		return $this->_method('basic', array('twitter_screen_name' => $twitterScreenName));
	}

	private function _method($method, $params = array()) {
		$url = "{$this->baseUrl}/{$this->version}/actor/{$method}";
		$params['api_key'] = $this->apiKey;
		return $this->get($url,$params);
	}

	protected function get($url,$params) {

		if ($params) {
			$url = $url.'?'.http_build_query($params);
		}
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$response = curl_exec($ch);
		curl_close($ch);
	
		if ($this->format == 'json') {
			$response = json_decode($response, true);
		}
	
		return $response;
	}

}