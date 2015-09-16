<?php
include "state.php";
// path 40 char
// update: shell_exec ( "apt-file update -c cache / 2>&1" );
// TODO: HTML entities out
class depsolv {
	private $naam;
	/**
	 *
	 * @param unknown $naam        	
	 */
	public function search($naam) {
		// $this->naam = $naam;
		$this->naam = "Xrender.h";
		
		$repoFiles = $this->getFileSearch ();
		var_dump ( $repoFiles );
	}
	
	/**
	 *
	 * @param unknown $naam        	
	 * @return string
	 */
	private function getDescription($naam) {
		$descp = shell_exec ( "apt-cache show " . $this->naam . " | awk '/Description-en:/ {flag=1;next} /Description-md5/{flag=0} flag {print}' | sed 's/Description-en://g'| tr -d '\n'" );
		$descp = substr ( $descp, 0, 200 ) . " [..]";
		return $descp;
	}
	
	/**
	 *
	 * @return multitype:unknown
	 */
	private function getFileSearch() {
		// $loc = shell_exec ( "apt-file search " . $this->naam . " -c cache | wc -l");
		$res = shell_exec ( "apt-file search " . $this->naam . " -c cache" );
		$res = str_replace ( ":", "", $res );
		$res = preg_replace ( '/\s+/', ' ', trim ( $res ) );
		$res = explode ( " ", $res );
		$tmpArray = array ();
		
		foreach ( array_chunk ( $res, 2 ) as $values ) {
			$tmpArray [$values [0]] = array (
					$values [0] => $values [1] 
			);
		}
		
		$searchArray = array ();
		
		$i = 0;
		foreach ( $tmpArray as $arr ) {
			echo array_keys ( $arr )[0] . "<br>";
			
			if (array_key_exists ( array_keys ( $arr )[0], $searchArray )) {
				echo "exist";
				continue;
			} else {
				$searchArray [] = $arr;
			}
		}
		
		return $searchArray;
	}
}
?>