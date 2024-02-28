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
        <form action="login_handler.php" method="POST" class="login-form-container gap-5 height-100">
            <?php
            if (isset($_GET['prompt'])) {
                echo '<p class="align-self-center size-16 color-danger">' . $_GET['prompt'] . '</p>';
            }
            ?>
            <p class="color-white size-20 border-bottom-1px-grey">Welcome, please login ...</p>
            <br>
            <br>
            <br>
            <br>
            <div class="flex-column gap-20">
                <div class="flex-column gap-5">
                    <label class="size-14 color-white">Email address</label>
                    <input type="text" name="email" class="form-input-2 background-none color-white" autofocus placeholder="Enter email" required>
                </div>
                <div class="flex-column gap-5">
                    <label class="size-14 color-white">Password</label>
                    <input type="password" name="password" class="form-input-2 background-none color-white" placeholder="Enter password" required>
                </div>
            </div>

            <div class="m-top-auto flex-column gap-20">
                <input type="submit" value="Login" name="submit" class="weight-600 color-white padding-10 radius-10 background-primary-variant">
                <div class="flex-row align-center gap-10">
                    <p class="color-white">Don't have an account yet? </p>
                    <a href="index.php" class="weight-500 color-primary-variant">Register</a>
                </div>

            </div>

            <!-- <a href="forgot_password.php" class="align-self-center color-blue">Forgot password?</a> -->

        </form>
    </div>


    

</body>

</html>