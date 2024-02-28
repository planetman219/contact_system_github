<?php

require_once 'database_connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="" href="base.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

</head>

<body>

    <div class="login-container">
        <form action="user_registration_handler.php" method="POST" class="login-form-container gap-5 height-100">
            <?php
            if (isset($_GET['prompt'])) {
                echo '<p class="align-self-center size-16 color-success">' . $_GET['prompt'] . '</p>';
            }
            ?>
            <p class="color-white size-20 border-bottom-1px-grey">Welcome, please sign up ...</p>
            <br>
            <div class="flex-column gap-20 media-max-height-reduce-1 media-scroll-y">
                <div class="flex-column gap-5">
                    <label class="size-14 color-white">Name</label>
                    <input type="text" name="name" class="form-input-2 background-none color-white" placeholder="Enter name" autofocus required>
                </div>
                <div class="flex-column gap-5">
                    <label class="size-14 color-white">Email</label>
                    <input type="text" id="email_input" name="email" class="form-input-2 background-none color-white" placeholder="Enter email" required>
                </div>
                <div class="flex-column gap-5">
                    <label class="size-14 color-white">Password</label>
                    <input type="password" name="password" class="form-input-2 background-none color-white" placeholder="Enter password" required>
                </div>
                <div class="flex-column gap-5">
                    <label class="size-14 color-white">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-input-2 background-none color-white" placeholder="Reenter password" required>
                </div>
                <p id="password-match">Password does not match</p>
                <br>
            </div>

            <div class="m-top-auto flex-column gap-20">
                <input type="submit" value="Submit" name="submit" class="weight-600 color-white padding-10 radius-10 background-primary-variant">
                <div class="flex-row align-center gap-10">
                    <p class="color-white">Already have an account? </p>
                    <a href="login.php" class="weight-500 color-primary-variant">Login</a>
                </div>

            </div>

            <!-- <a href="forgot_password.php" class="align-self-center color-blue">Forgot password?</a> -->

        </form>
    </div>

    <script>
        $("#email_input").on("input", function() {

            let inputValue = $(this).val()

            $.ajax({
                type: 'post',
                url: 'check_duplicate_email_handler.php',
                data: {
                    inputValue: inputValue
                },
                success: function(response, status) {
                    if (response == 'duplicate') {
                        alert("Email already have an account")

                        $('input[name="submit"]').prop('disabled', true);
                    } else if (response == 'valid') {

                        $('input[name="submit"]').prop('disabled', false);
                    }

                }
            })
        });

        $('input[name="confirm_password"]').on("input", function() {
            if($(this).val() !== $('input[name="password"]').val()) {
                $('input[name="submit"]').prop('disabled', true);

                $("#password-match").text('Password does not match')

                $("#password-match").removeClass("color-success")
                $("#password-match").addClass("color-warning")
            } else {
                $('input[name="submit"]').prop('disabled', false);

                $("#password-match").text('Password match')

                $("#password-match").removeClass("color-warning")
                $("#password-match").addClass("color-success")
                
            }
        })
    </script>



</body>

</html>