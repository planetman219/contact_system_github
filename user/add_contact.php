<?php
include_once 'header.php';
require_once '../database_connection.php';

$user_id = $_SESSION['user_id'];

$sqlContacts = "SELECT * FROM contact WHERE user_id = $user_id";
$resultContacts = mysqli_query($conn, $sqlContacts);
$contacts = [];
if (mysqli_num_rows($resultContacts) > 0) {
    while ($rowContacts = mysqli_fetch_assoc($resultContacts)) {
        $contacts[] = $rowContacts;
    }
}

?>


<main>

    <div class="background-white padding-20 radius-5 table-container">
        <div class="flex-row align-center justify-space-between">
            <div class="flex-row gap-10 align-center">
                <h3>Add Contact</h3>
            </div>

            <a href="add_contact.php" class="background-primary flex-row align-center gap-5   padding-10 radius-5 hover-gray-background">
                <span class="material-symbols-outlined size-16">add</span>
                <p>Add Contact</p>
            </a>
        </div>
        <br>

        <form action="handlers/insert_contact_handler.php" method="POST" class="login-form-container gap-5 height-100">
            <div class="flex-column gap-20 media-max-height-reduce-1 media-scroll-y">
                <div class="flex-column gap-5">
                    <label class="size-14  ">Name</label>
                    <input type="text" name="name" class="form-input-2 background-none  " placeholder="Enter name" required>
                </div>
                <div class="flex-column gap-5">
                    <label class="size-14  ">Company</label>
                    <input type="text" id="student_email_input" name="company" class="form-input-2 background-none  " placeholder="Enter compnay" required>
                </div>
                <div class="flex-column gap-5">
                    <label class="size-14  ">Phone</label>
                    <input type="text" name="phone" class="form-input-2 background-none  " placeholder="Enter phone" required>
                </div>
                <div class="flex-column gap-5">
                    <label class="size-14  ">Email</label>
                    <input type="text" id="student_email_input" name="email" class="form-input-2 background-none  " placeholder="Enter email" required>
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