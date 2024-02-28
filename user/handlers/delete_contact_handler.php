<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("location: ../login.php?prompt = Access denied");
    exit();
}
require_once '../../database_connection.php';

$user_id = $_SESSION['user_id'];

if(isset($_POST['contact_id'])) {
    $contact_id = $_POST['contact_id'];

    $sqlDeleteContact = "DELETE FROM contact WHERE contact_id = $contact_id";
    $resultDeleteContact = mysqli_query($conn, $sqlDeleteContact);

    if ($resultDeleteContact) {
        header("Location: ../contacts.php?prompt=Contact Delete Successfully");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
