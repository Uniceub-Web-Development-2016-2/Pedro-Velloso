<?php

class Math{

	private $num_1;
	private $num_2;

	public function  __construct($num_1, $num_2){
		$this->num_1 = $num_1;
		$this->num_2 = $num_2;
	}

	public function sumAttr(){
		return $this->sum($this->num_1, $this->num_2);
	}

	public function sum($num_1, $num_2){
	
		if($num_1 < 0 || $num_2 < 0)
			return  "Can not sum 0";
		return $num_1 + $num_2;
	}

	public function sumAll($numsArr){
		$sum = 0;
		foreach($numsArr as $num){
			$sum = $sum + $num;
		}

		return $sum;
	}

}

$math = new Math(2, 1);
echo $math->sumAttr();
echo "<br>";
echo $math->sum(-1, 0);
$array = array(6,6,6);
echo "<br>";
echo $math->sumAll($array);
