<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("location: ../login.php?prompt = Access denied");
    exit();
}
require_once '../../database_connection.php';

$user_id = $_SESSION['user_id'];

if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    

    $sqlInsertContact = "INSERT INTO contact (user_id, name, company, phone, email)
                                VALUES ($user_id, '$name', '$company', '$phone', '$email')";
    $resultInsertContact = mysqli_query($conn, $sqlInsertContact);
    if ($resultInsertContact) {
        header("Location: ../contacts.php?prompt=New Contact Successfully Added");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
