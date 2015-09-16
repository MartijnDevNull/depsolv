<?php
include "depsolv.php";
$deps = new depsolv();

//sleep(1);
echo $deps->getDescription($_POST['q']);
?>