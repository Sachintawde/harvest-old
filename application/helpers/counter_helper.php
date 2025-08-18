<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('count_visitor')) {
		function count_visitor(){
			$counter_name = dirname(FCPATH)."/konale_classes/counter.txt";
			// echo $counter_name;die;

			// Check if a text file exists.
			// If not create one and initialize it to zero.
			if (!file_exists($counter_name)) {
			  $f = fopen($counter_name, "w");
			  fwrite($f,"0");
			  fclose($f);
			}
			
			// Read the current value of our counter file
			$f = fopen($counter_name,"r");
			$counterVal = fread($f, filesize($counter_name));
			fclose($f);

			// Has visitor been counted in this session?
			// If not, increase counter value by one
			if (is_null(get_cookie('has'))) {
				setcookie("has", true, time()+ 8600 * 30,'/');
				$counterVal++;
			  	$f = fopen($counter_name, "w");
			  	fwrite($f, $counterVal);
			  	fclose($f);
			}
			return $counterVal;
		}
	}
?>