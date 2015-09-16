<?php
include "depsolv.php";
$deps = new depsolv();

//sleep(1);
echo $deps->search($_POST['q']);
?>