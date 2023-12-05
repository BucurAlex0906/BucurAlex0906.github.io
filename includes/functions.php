<?php

function db_connect($host = "localhost", $username = "renewablenergy", $password = "renewablenergy", $dbname = "renewablenergy"){
	return mysqli_connect($host, $username, $password, $dbname);
}

?>