<?php
include_once ('request.php');
class ResourceController
{	
 	private $METHODMAP = ['GET' => 'search' , 'POST' => 'create' , 'PUT' => 'update', 'DELETE' => 'remove' ];
	
	public function treat_request($request) {
		return $this->{$this->METHODMAP[$request->getMethod()]}($request);
	
	}
	private function search($request) {
		$query = 'SELECT * FROM '.$request->getResource(). self::queryParams($request->getParameters()); 
		$conn = (new DBConnector())->query($query);
		return $conn->fetchAll(PDO::FETCH_ASSOC);
	}
		
	private function queryParams($params) {
		if($params != NULL){
		$query = " WHERE ";		
		foreach($params as $key => $value) {
			$query .= $key.' = "'.$value.'" AND ';	
		}
		$query = substr($query,0,-5);
		return $query;
		}
		return NULL;
	}
	
}