<?php

require_once 'database_connection.php';

if (isset($_POST['inputValue'])) {
    $inputValue = mysqli_real_escape_string($conn, $_POST['inputValue']);

    $sqlCheckEmailDuplicate = "SELECT * FROM user WHERE email = '$inputValue'";
    $resultCheckEmailDuplicate = mysqli_query($conn, $sqlCheckEmailDuplicate);
    if(mysqli_num_rows($resultCheckEmailDuplicate) > 0) {
        echo 'duplicate';
    } else {
        echo 'valid';
    }
}
