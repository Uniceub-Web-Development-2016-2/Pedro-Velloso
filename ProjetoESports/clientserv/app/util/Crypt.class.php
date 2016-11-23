<?php

class Crypt {

	public function generateHash($message) {
		if(CRYPT_BLOWFISH == 1){	
			$salt = '$2y$11$'. substr(md5(uniqid(rand(), true)),0,22);
			return crypt($message, $salt);
		}
	}

	public function verifyHash($userinput,$serveroutput) {
		return crypt($userinput,$serveroutput) == $serveroutput;
	}
	
}
