<?php
include "state.php";
// update: shell_exec ( "apt-file update -c cache / 2>&1" );
// TODO: HTML entities out
class depsolv {
	private $name;
	/**
	 *
	 * @param unknown $name        	
	 */
	public function search($name) {
		$this->name = $name;
		// $this->name = "Xrender.h";
		
		$repoFiles = $this->getFileSearch ();
		
		$formattedHits = array ();
		
		foreach ( $repoFiles as $hit ) {
			$formattedHits [] = array (
					"NAME" => html_entity_decode ( array_keys ( $hit )[0] ),
					"PATH" => html_entity_decode ( $hit [array_keys ( $hit )[0]] ),
					"DESC" => html_entity_decode ( $this->getDescription ( array_keys ( $hit )[0] ) ) 
			);
		}
		
		return json_encode ( $formattedHits );
	}
	
	/**
	 *
	 * @param unknown $name        	
	 * @return string
	 */
	private function getDescription($name) {
		$descp = shell_exec ( "apt-cache show " . $name . " | awk '/Description-en:/ {flag=1;next} /Description-md5/{flag=0} flag {print}' | sed 's/Description-en://g'| tr -d '\n'" );
		$descp = substr ( $descp, 0, 200 ) . " [..]";
		return $descp;
	}
	
	/**
	 *
	 * @return multitype:unknown
	 */
	private function getFileSearch() {
		$loc = shell_exec ( "apt-file search " . $this->name . " -c cache | wc -l" );
		if ($loc != 0 || $loc <= 50) {
			$res = shell_exec ( "apt-file search " . $this->name . " -c cache" );
			$res = str_replace ( ":", "", $res );
			$res = preg_replace ( '/\s+/', ' ', trim ( $res ) );
			$res = explode ( " ", $res );
			$tmpArray = array ();
			
			foreach ( array_chunk ( $res, 2 ) as $values ) {
				$tmpArray [$values [0]] = array (
						$values [0] => (strlen ( $values ['1'] ) > 36) ? "[..]" . substr ( $values [1], - 36 ) : $values [1] 
				);
			}
			
			$searchArray = array ();
			
			foreach ( $tmpArray as $arr ) {
				if (array_key_exists ( array_keys ( $arr )[0], $searchArray )) {
					continue;
				} else {
					$searchArray [] = $arr;
				}
			}
			
			return $searchArray;
		} elseif ($loc == 0) {
			return state::Emtpy;
		} elseif ($loc >= 50) {
			return state::ToBig;
		}
	}
}
?>