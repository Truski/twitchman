<?php
if(!function_exists('edit')){
	function edit($key, $value){
		if(!write_file(DIRECTORY . $key . ".txt", $value)){
			die("Unable to write the file");
		}
	}
}

if(!function_exists('contents')){
	function contents($key){
		return file_get_contents(DIRECTORY . $key . ".txt");
	}
}

if(!function_exists('round_name')){
	function round_name($code){
		switch($code){
			case 1:
				return "Winners Quarterfinals";
			case 2:
				return "Winners Semifinals";
			case 3:
				return "Winners Finals";
			case 4:
				return "Grand Finals";
			case -1:
				return "Losers Round 1";
			case -2:
				return "Losers Quarterfinals";
			case -3:
				return "Losers Semifinals";
			case -4:
				return "Losers Finals";
			default:
				return "Unknown Round";
		}
	}
}