<?php


$username="root";
$password="abc123$";
$database="vmware";

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die("Unable to select database");
?>
