<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("location: ../login.php?prompt= Access denied");
    exit();
}


require_once '../database_connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,300,0,0" />
    <link rel="stylesheet" href="../base.css">

    <script defer src="../assets/javascript/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <nav class="background-primary">

        <h3 class="color-white align-self-center">Contact System</h3>

        <div class="flex-column align-center gap-5 width-100">
            <a href="contacts.php" class="flex-row align-center nav-link gap-5 ">
                <span class="material-symbols-outlined">groups</span>
                <p class="size-14">Contacts</p>
            </a>
            <br>
            <a href="../logout.php" class="flex-row align-center nav-link gap-5 ">
                <span class="material-symbols-outlined size-30">logout</span>
                <p class="size-14">Logout</p>
            </a>

        </div>
    </nav>

    <button data-modal-target="#user-guide-modal" id="open-user-guide-button" class="hover-gray-background">
        <span class="material-symbols-outlined size-30">help</span>
    </button>