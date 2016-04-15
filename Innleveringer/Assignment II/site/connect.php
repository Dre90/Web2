<?php
    //Connect to the database
    function getDB() {
        $host = 'localhost';
        $user = 'newspaper_admin';
        $pass = 'newspaper_admin';
        $db = 'newspaper_db';

		$db = new mysqli($host, $user, $pass, $db);
		if ($db->connect_errno) {
            die("Kan ikke koble til databasen: Prøv igjen senere"); }	
        return $db;
    }
 ?>
