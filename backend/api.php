<?php
include "depsolv.php";
$deps = new depsolv();

echo $deps->search($_REQUEST['q']);
if ($_REQUEST['update'] == "y"){
	$deps->update();
}
?>