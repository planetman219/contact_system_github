<?php
session_start();
require_once 'database_connection.php';

if (isset($_POST['submit'])) {


    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sqlInsertUser = "INSERT INTO user (name, email, password)
                                VALUES ('$name', '$email', '$hashedPassword')";
    $resultInsertUser = mysqli_query($conn, $sqlInsertUser);
    if ($resultInsertUser) {
        $user_id = mysqli_insert_id($conn);

        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        header("Location: thank_you_page.php?prompt=Thank you for registering");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
