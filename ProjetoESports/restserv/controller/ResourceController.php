<?php

class ResourceController{

	private $method_map = ['GET' => 'getController', 'POST' => 'postController', 'PUT' => 'update', 'DELETE' => 'deleteController'];

	public function treat_request($request){

		return $this->{$this->method_map[$request->get_Method()]}($request);

	}

	private function postController($request){
		if($request->get_Operation() == "" || is_null($request->get_Operation()))
			return $this->create($request);
		return $this->{$request->get_Operation()}($request);
	}

	private function getController($request){
		if($request->get_Operation() == "" || is_null($request->get_Operation()))
			return $this->search($request);
		return $this->{$request->get_Operation()}($request);
	}

	private function deleteController($request){
		if($request->get_Operation() == "" || is_null($request->get_Operation()))
			return $this->remove($request);
		return $this->{$request->get_Operation()}($request);
	}

	private function remove($request){
		$removeBody = json_decode($request->get_Body(), true);
		$query = 'DELETE FROM ' . $request->get_Resource() . " WHERE id = '" .$removeBody['id']. "'";
		return (new Connector())->exec($query);
	}

	private function discard($request){
		$removeBody = json_decode($request->get_Body(), true);
		$query = 'DELETE FROM ' . $request->get_Resource() . " WHERE eventsId = '" .$removeBody['id']. "'";
		return (new Connector())->exec($query);
	}

	private function auth($request){
		$loginBody = json_decode($request->get_Body(), true);
		$query = 'SELECT * FROM ' . $request->get_Resource() . " WHERE username = '".$loginBody['username']. "'";
		$result = (new Connector())->query($query);
		return $result->fetchAll(PDO::FETCH_ASSOC);		
	}

	private function search($request){

		$query = "SELECT * FROM `"  . $request->get_Resource() . "`" . self::queryParams($request->get_Params());
		$result = (new Connector())->query($query);
		return $result->fetchAll(PDO::FETCH_ASSOC);

	}

	private function list($request){

		$query = "SELECT * FROM `"  . $request->get_Resource() . "`" . self::queryParams($request->get_Params()) . " ORDER BY id DESC LIMIT 10";
		$result = (new Connector())->query($query);
		return $result->fetchAll(PDO::FETCH_ASSOC);

	}

	private function queryParams($params){
		if($params != NULL){
		$query = " WHERE ";		
		foreach($params as $key => $value) {
			$query .= $key." = '".$value."' AND ";	
		}
		$query = substr($query,0,-5);
		return $query;
		}
		return NULL;
	}

	private function create($request){

		$body = $request->get_Body();
		$resource = $request->get_Resource();
		$query = "INSERT INTO {$resource} ({$this->getCollums($body)}) VALUES {$this->getValues($body)}";
		$prep = (new Connector())->exec($query);
		return $this->createCheck($prep);

	}

	private function createCheck($checker){

		if(!$checker)
			return array("code" => "error");
		return array("code" => "success");

	}

	private function update($request) {
        $body = $request->get_Body();
        $resource = $request->get_Resource();
        $query = 'UPDATE '.$resource.' SET '. $this->getUpdateCriteria($body);
		return (new Connector())->exec($query);
    }

    private function getUpdateCriteria($json){
	$criteria = "";
	$where = " WHERE ";
	$array = json_decode($json, true);
	foreach($array as $key => $value) {
		if($key != 'id')
			$criteria .= $key." = '".$value."',";	
		}
		return substr($criteria, 0, -1).$where." id = ".$array['id'];
	}	
	

	private function getCollums($json){

		$body = json_decode($json, true);
		$keys = array_keys($body);
		return implode(",", $keys);

	}

	private function getValues($json){

		$body = json_decode($json, true);
		$values = array_values($body);
		$valuesString = implode("','", $values);
		return "('{$valuesString}')";


	}

}