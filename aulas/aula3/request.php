<?php
class Request{
	private $method;
	private $protocol;
	private $ip;
	private $remote_ip;
	private $resource;
	private $parameters;
	
	//Construtor
	public function __construct($method, $protocol, $ip, $remote_ip, $resource, $parameters){
		$this->method = $method;
		$this->protocol = $protocol;
		$this->ip = $ip;
		$this->remote_ip = $remote_ip;
		$this->resource = $resource;
		$this->parameters = $parameters;	
	}
	//Metodo para gerar string
	public function toString(){
	  	$parameters = "";
		foreach($this->parameters as $key => $value){
			$parameters = $parameters . $key . "=" . $value . "&";
		}
		return $this->protocol . "://" . $this->ip  . "/" . $this->resource  . "?" . substr($parameters, 0, -1); 	
	}
	
	//Gets e Sets dos Atributos
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
	
	public function set_Ip($ip){
		$this->ip = $ip;
	}
	public function get_Ip(){
		return $this->ip;
	}
	public function set_RemoteIp($remote_ip){
		$this->remote_ip = $remote_ip;
	}
	public function get_RemoteIp(){
		return $this->remote_ip;
	}
	public function set_Resource($resource){
		$this->resource = $resource;
	}
	public function get_Resource(){
		return $this->resource;
	}
	public function set_Parameters($parameters){
		$this->parameters = $parameters;		
	}
	public function get_Parameters(){
		return $this->parameters;
	}
	
	
}
