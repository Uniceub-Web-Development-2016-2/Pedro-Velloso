<?php

class RequestController{
	
	private $VALID_METHODS = array('GET', 'POST', 'PUT', 'DELETE');


	public function execute(){

    	$request = self::create_request($_SERVER);
    	$resource = new ResourceController();
    	return $resource->treat_request($request);

    }

	private function create_request($request_info){
		
        if(!self::is_valid_method($request_info['REQUEST_METHOD']))
        {
            return array("code" => "405", "message" => "Method not allowed");      
        }  
        if(!self::is_valid_remote_addr($request_info['REMOTE_ADDR'])){
            return array("code" => "401", "message" => "You must be authorized to view this page");
        }
        if(!self::is_valid_protocol($request_info["SERVER_PROTOCOL"])){
            return array("code" => "505", "message" => "Protocol not supported");
        }

        $body = file_get_contents('php://input');
        return new Request($request_info['REQUEST_METHOD'], $request_info["SERVER_PROTOCOL"], $request_info['SERVER_ADDR'], $request_info['REMOTE_ADDR'], $request_info['REQUEST_URI'], $request_info['QUERY_STRING'], $body);
 
       
    }

    private function is_valid_method($method){
        if(is_null($method) || !in_array($method, $this->VALID_METHODS))
            return false;       
        return true;
    }

    private function is_valid_protocol($protocol){
        if(is_null($protocol) || $protocol != "HTTP/1.1")
            return false;
        return true;
    }

    private function is_valid_remote_addr($remote_addr){
        if(is_null($remote_addr) || filter_var($remote_addr, FILTER_VALIDATE_IP) === FALSE)
            return false;
        return true;
    }
}