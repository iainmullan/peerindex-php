<?php
/**
 *	A PHP wrapper for the PeerIndex API
 *
 *	@see http://dev.peerindex.com/
 *	@author Iain Mullan <iain.mullan@gmail.com>, @iainmullan
 *	@license MIT <http://opensource.org/licenses/MIT>
 **/
class PeerIndexAPI {

	private $apiKey;
	private $baseUrl = 'http://api.peerindex.net';
	private $version = 'v2';
	private $format = 'json';

	function __construct($apiKey) {
		$this->apiKey = $apiKey;
	}

	function profile($twitterScreenName) {
		return $this->_method('profile', array('id' => $twitterScreenName));
	}

	function show($twitterScreenName) {
		return $this->_method('show', array('id' => $twitterScreenName));
	}

	function _method($method, $params = array()) {
		$url = "{$this->baseUrl}/{$this->version}/profile/{$method}.{$this->format}";
		$params['api_key'] = $this->apiKey;
		return $this->get($url,$params);
	}

	function get($url,$params) {

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