<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
	}

	function index()
	{
		$obj = array(
					'data' => array('user' => 'y02x5JAAAAAJ'),
					'function' => 'get_google_scholar' 
				);
		$rest = $this->_sample_api($obj);
		var_dump($rest);
	}
	
	function _sample_api( $object = array() )
	{	
		$content = NULL;
		
		if( function_exists('curl_version') )
		{
			//Server url
			$url = 'https://api.uad.ac.id/index.php?d=scraping&c=Google_scholar&m='. $object['function'];
			$headers = array('U4D-API-KEY: 2ac4fd56546a409d4655f3cc54788e0ff682da7a');
			
			try {
				$ch = curl_init();

				if (FALSE === $ch)
					throw new Exception('failed to initialize');

				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				// curl_setopt($curl_handle, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				if(isset($object['data'])) 
				{
					curl_setopt($ch, CURLOPT_POSTFIELDS, $object['data'] );
				}

				$content = curl_exec($ch);

				if (FALSE === $content)
					throw new Exception(curl_error($ch), curl_errno($ch));
				// ...process $content now
			} catch(Exception $e) {
				trigger_error(sprintf(
					'Curl failed with error #%d: %s',
					$e->getCode(), $e->getMessage()),
					E_USER_ERROR);
			}
		}
		
		return $content;
	}
}