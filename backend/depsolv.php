<?php
// path 40 char
class depsolv {
	public function edi() {
	}
	public function getDescription($naam) {
		$descp = shell_exec ( "apt-cache show $naam | awk '/Description-en:/ {flag=1;next} /Description-md5/{flag=0} flag {print}' | sed 's/Description-en://g'| tr -d '\n'" );
		$descp = substr ( $descp, 0, 200 ) . " [..]";
		return $descp;
	}
}
?>