<?php

$conn = mysqli_connect('localhost','root','','contact_system');

if(!$conn) {
    die(mysqli_connect_error());
}

// die(mysqli_error($conn)); this is for oop mysqli connection

?>