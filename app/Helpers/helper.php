<?php

namespace App\Helpers;
use GuzzleHttp\Client;

 
class Helper {

	/**
		get random string of 25 character
	**/
	public function getRandomString() {
		 return substr(sprintf( '%04x%04x%04x%04x%04x%04x%04x%04x',
	            // 32 bits for "time_low"
	            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

	            // 16 bits for "time_mid"
	            mt_rand( 0, 0xffff ),

	            // 16 bits for "time_hi_and_version",
	            // four most significant bits holds version number 4
	            mt_rand( 0, 0x0fff ) | 0x4000,

	            // 16 bits, 8 bits for "clk_seq_hi_res",
	            // 8 bits for "clk_seq_low",
	            // two most significant bits holds zero and one for variant DCE1.1
	            mt_rand( 0, 0x3fff ) | 0x8000,

	            // 48 bits for "node"
	            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	        ),0,24);
	}
	/**
		hash generater using required param and  using sha512 algo
	**/

	public function generateHash($requestParam) {
		$string = $requestParam['key']."|".$requestParam['txnid']."|".$requestParam['amount']."|".$requestParam['productinfo']."|".$requestParam['firstname']."|".$requestParam['email']."|||||||||||".$requestParam['salt'];
		
		
		// $string = "C0Dr8m|12345|10|Shopping|Test|test@test.com||abc||15|||||||3sf0jURk";
		
		return (hash('sha512', $string));
		 

	// 	sha512(C0Dr8m|12345|10|Shopping|Test|test@test.com||abc||15|||||||3sf0j
	// URk)
	}


	
}
?>