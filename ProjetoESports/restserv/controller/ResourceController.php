<?php

class ResourceController{

	private $method_map = ['GET' => 'search', 'POST' => 'create', 'PUT' => 'update', 'DELETE' => 'remove'];

	public function treat_request($request){

		return $this->{$this->method_map[$request->get_Method()]}($request);

	}

	private function search($request){

		$query = 'SELECT * FROM ' . $request->get_Resource() . self::queryParams($request->get_Params());
		$result = (new Connector())->query($query);
		return $result->fetchAll(PDO::FETCH_ASSOC);

	}

	private function queryParams($params){
		if($params != NULL){
		$query = " WHERE ";		
		foreach($params as $key => $value) {
			$query .= $key." LIKE '%".$value."%' AND ";	
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