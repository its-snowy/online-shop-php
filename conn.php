<?php
$db = new mysqli('localhost', 'root', '', 'student_db');

if ($db->connect_error) {
    die("fail connect: ". $db->connect_error);
}

?>
