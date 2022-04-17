<?php
require("../require/sql.php");
header("Content-type: application/json");
$users = $cpconn->query("SELECT * FROM users");
$servers = $cpconn->query("SELECT * FROM servers");
die(json_encode(array("users"=>$users->num_rows,"servers"=>$servers->num_rows)))
?>