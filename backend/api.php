<?php
include "depsolv.php";
$deps = new depsolv ();

if (isset ( $_REQUEST ['q'] )) {
	echo $deps->search ( $_REQUEST ['q'] );
}
if ($_REQUEST ['update'] == "y") {
	$deps->update ();
}
?>