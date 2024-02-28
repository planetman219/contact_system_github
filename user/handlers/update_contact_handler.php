<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("location: ../login.php?prompt = Access denied");
    exit();
}
require_once '../../database_connection.php';

$user_id = $_SESSION['user_id'];

if(isset($_POST['submit'])) {
    $contact_id = $_POST['contact_id'];

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    

    $sqlUpdateContact = "UPDATE contact SET  
                                name = '$name', 
                                company = '$company', 
                                phone = '$phone', 
                                email = '$email'
                                WHERE contact_id = $contact_id";
    $resultUpdateContact = mysqli_query($conn, $sqlUpdateContact);
    if ($resultUpdateContact) {
        header("Location: ../contacts.php?prompt=Contact Updated Successfully");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
