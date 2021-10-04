<?php

namespace App;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class GuzzleHttpApi
{
	private $clienteHttp;
	private $uriHttp;

	function __construct()
	{
		$this->clienteHttp= new \GuzzleHttp\Client();
		$this->uriHttp = '';
	}

	public function sendRequest($method='GET', $url='', $params)
	{
	}
}
