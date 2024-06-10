<?php
include_once("conn.php");

// Get the student ID from the query string
$id = $_GET['id'];

// Delete the student from the database
$sql = "DELETE FROM students WHERE id=$id";

if ($db->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Error deleting record: ". $db->error;
}

$db->close();
?>