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
                <h3>Contacts</h3>
            </div>

            <a href="add_contact.php" class="background-primary flex-row align-center gap-5 color-white padding-10 radius-5 hover-gray-background">
                <span class="material-symbols-outlined size-16">add</span>
                <p>Add Contact</p>
            </a>
        </div>
        <br>
        <div class="flex-row justify-end">
            <input type="text" placeholder="search" class="form-input" id="search-input">

        </div>
        <div id="contacts-list-container">

        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        displayContactsList(1)

        prompt('prompt')
    })

    function prompt(prompt_name) {
        // Get the URLSearchParams object from the current URL
        const urlParams = new URLSearchParams(window.location.search);

        // Get the value of the 'prompt' parameter
        const promptValue = urlParams.get(prompt_name);

        // Check if the 'prompt' parameter exists
        if (promptValue !== null) {
            // Use the prompt value as needed
            alert(promptValue);
        }
    }

    function displayContactsList(page_no) {
        let getContacts = true

        $.ajax({
            type: 'post',
            url: 'handlers/get_contacts_list_handler.php',
            data: {
                getContacts: getContacts,
                page_no: page_no
            },
            success: function(response, status) {
                $("#contacts-list-container").html(response)
            }
        })
    }

    function changePage(page_number) {
        displayContactsList(page_number)
    }

    function nextPage(currentPageNumber, totalPages) {
        if (currentPageNumber < totalPages) {
            displayContactsList(currentPageNumber + 1)

        }

    }

    function prevPage(currentPageNumber, totalPages) {
        if (currentPageNumber > 1) {
            displayContactsList(currentPageNumber - 1)
        }

    }








    // search contact
    function searchContact(page_no) {
        let search_contact = true;

        let search_input = $("#search-input").val()

        $.ajax({
            type: 'post',
            url: 'handlers/search_contact_handler.php',
            data: {
                search_contact: search_contact,
                search_input: search_input,
                page_no: page_no
            },
            success: function(response, status) {
                $("#contacts-list-container").html(response)

            }
        })
    }


    $("#search-input").on("input", function() {
        event.preventDefault();

        let page_no = 1;

        searchContact(page_no);
    });


    function searchChangePage(page_number) {
        searchContact(page_number)
    }

    function searchPrevPage(currentPageNumber, totalPages) {
        if (currentPageNumber > 1) {
            searchContact(currentPageNumber - 1)
        }
    }

    function searchNextPage(currentPageNumber, totalPages) {
        if (currentPageNumber < totalPages) {
            searchContact(currentPageNumber + 1)
        }
    }
</script>

<script>
    $(document).ready(function() {
        // delete user
        $("body").on('click', ".delBtn", function(e) {
            e.preventDefault()
            let tr = $(this).closest('tr');
            let contact_id = $(this).attr('id')

            Swal.fire({
                title: "Are you sure you want to delete?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'handlers/delete_contact_handler.php',
                        type: 'post',
                        data: {
                            contact_id: contact_id
                        },
                        success: function(response) {
                            tr.css('background-color', '#ff6666')

                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Your file has been deleted.',
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload()
                                }
                            });


                        }
                    })
                }
            })
        })
    })
    $(".table-datatable").DataTable({
        order: [
            [0, 'asc']
        ]
    })
</script>

</body>

</html>