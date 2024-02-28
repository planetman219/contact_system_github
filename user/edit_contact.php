<?php
include_once 'header.php';
require_once '../database_connection.php';

$user_id = $_SESSION['user_id'];

if(isset($_GET['contact_id'])) {
    $contact_id = $_GET['contact_id'];

    $sqlGetContact = "SELECT * FROM contact WHERE contact_id = $contact_id";
    $resultGetContact = mysqli_query($conn, $sqlGetContact);
    $rowGetContact = mysqli_fetch_assoc($resultGetContact);
}

?>


<main>

    <div class="background-white padding-20 radius-5 table-container">
        <div class="flex-row align-center justify-space-between">
            <div class="flex-row gap-10 align-center">
                <h3>Edit Contact</h3>
            </div>

        </div>
        <br>

        <form action="handlers/update_contact_handler.php" method="POST" class="login-form-container gap-5 height-100">
            <input type="hidden" value="<?= $rowGetContact['contact_id'] ?>" name="contact_id">
            <div class="flex-column gap-20 media-max-height-reduce-1 media-scroll-y">
                <div class="flex-column gap-5">
                    <label class="size-14  ">Name</label>
                    <input type="text" name="name" class="form-input-2 background-none" value="<?= $rowGetContact['name'] ?>" required>
                </div>
                <div class="flex-column gap-5">
                    <label class="size-14  ">Company</label>
                    <input type="text" name="company" class="form-input-2 background-none  " value="<?= $rowGetContact['company'] ?>" required>
                </div>
                <div class="flex-column gap-5">
                    <label class="size-14  ">Phone</label>
                    <input type="text" name="phone" class="form-input-2 background-none  " value="<?= $rowGetContact['phone'] ?>" required>
                </div>
                <div class="flex-column gap-5">
                    <label class="size-14  ">Email</label>
                    <input type="text" name="email" class="form-input-2 background-none  " value="<?= $rowGetContact['email'] ?>" required>
                </div>

                <br>
            </div>

            <div class="m-top-auto flex-column gap-20">
                <input type="submit" value="Submit" name="submit" class="weight-600   padding-10 radius-10 background-primary-variant">
            </div>
        </form>
    </div>
</main>

<script>
    $(".table-datatable").DataTable({
        order: [
            [0, 'asc']
        ]
    })
</script>

</body>

</html>