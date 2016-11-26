<?php

class Request{
	
	private $method;
	private $protocol;
	private $server_ip;
	private $remote_ip;
	private $resource;
	private $params;
	private $body;
	private $operation;

	public function __construct($method, $protocol, $server_ip, $remote_ip, $resource, $params, $body){

		$this->method = $method;
		$this->protocol = $protocol;
		$this->server_ip = $server_ip;
		$this->remote_ip = $remote_ip;
		$this->set_Resource($resource);
		$this->set_Params($params);
		$this->body = $body;
		$this->set_Operation($resource);

	}


	//GETS & SETS
	public function set_Method($method){
		$this->method = $method;
	}

	public function get_Method(){
		return $this->method;
	}

	public function set_Protocol($protocol){
		$this->protocol = $protocol;
	}

	public function get_Protocol(){
		return $this->protocol;
	}

	public function set_ServerIp($server_ip){
		$this->server_ip = $server_ip;
	}

	public function get_ServerIp(){
		return $this->server_ip;
	}

	public function set_RemoteIp($remote_ip){
		$this->remote_ip = $remote_ip;
	}

	public function get_RemoteIp(){
		return $this->remote_ip;
	}

	public function set_Resource($resource){
		$s = explode("?", $resource);
        $r = explode("/", $s[0]);
        $this->resource = $r[2];
	}

	public function get_Resource(){
		return $this->resource;
	}

	public function set_Params($params){
		parse_str($params, $paramsArray);
		$this->params = $paramsArray;
	}

	public function get_Params(){
		return $this->params;
	}

	public function set_Body($body){
		$this->body = $body;
	}

	public function get_Body(){
		return $this->body;
	}

	public function set_Operation($resource){
		$s = explode("?", $resource);
        $r = explode("/", $s[0]);
        $this->operation = $r[3];	
	}

	public function get_Operation(){
		return $this->operation;
	}


}