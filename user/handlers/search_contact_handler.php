<?php
session_start();
require_once '../../database_connection.php';

$user_id = $_SESSION['user_id'];

if (isset($_POST['search_contact'])) {
    $search_input = mysqli_real_escape_string($conn, $_POST['search_input']);
    $page_no = $_POST['page_no'];

    $columns = array();

    $sqlGetColumnNames = "SELECT column_name
                            FROM information_schema.columns
                            WHERE table_name = 'contact'";

    $resultGetColumnNames = mysqli_query($conn, $sqlGetColumnNames);

    if ($resultGetColumnNames) {
        while ($rowGetColumnNames = mysqli_fetch_assoc($resultGetColumnNames)) {
            $columns[] = $rowGetColumnNames['column_name'];
        }
    }

    // Generate the SQL query dynamically
    $query = "SELECT * FROM contact WHERE user_id = $user_id AND (";
    foreach ($columns as $column) {
        $query .= "$column LIKE '%$search_input%' OR ";
    }

    $query = rtrim($query, " OR ");

    $query .= ")";



    $resultContactRows = mysqli_query($conn, $query);
    $numRows = mysqli_num_rows($resultContactRows);

    $totalRows = $numRows; // Replace this with the actual total number of rows.
    $totalPages = ceil($totalRows / 10); // Assuming 10 rows per page.

    $html = '<p class=" padding-right-10">Total contacts : ' . $totalRows . '</p>';




    $offset = ($page_no - 1) * 10;

    $query .= "ORDER BY name LIMIT $offset, 10";
    $result = mysqli_query($conn, $query);




    $contacts = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $contacts[] = $row;
        }
    }

    $html .= '
        <table class="table table-scroll-x">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>COMPANY</th>
                    <th>PHONE</th>
                    <th>EMAIL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    ';

    foreach ($contacts as $contact) {
        $contact_id = $contact['contact_id'];

        $html .= '
        <tr>
            <td>' . $contact['name'] . '</td>
            <td>' . $contact['company'] . '</td>
            <td>' . $contact['phone'] . '</td>
            <td>' . $contact['email'] . '</td>
            <td>
                <div class="table-action-container">

                    <a href="edit_contact.php?contact_id=' . $contact["contact_id"] . '" class="media-dis-none table-action-link background-primary-variant">
                        EDIT
                    </a>
                    <a id="' . $contact['contact_id'] . '" href="" class="table-action-link background-danger delBtn">
                        DELETE
                    </a>

                </div>
            </td>
        </tr>
    ';
    }


    $html .= '</tbody>
    </table>';



    $html .= '
        <br>
        <div class="pagination flex-column align-center gap-5">
        
    
            <ul class="pagination-list">
                <li class="page-item">
                    <button class="page-link page-prev" onclick="searchPrevPage(' . $page_no . ', ' . $totalPages . ')">
                        <span class="material-symbols-outlined size-16 padding-left-7 weight-600">arrow_back_ios</span>
                    </button>
                </li>';




    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $page_no) {
            $html .= '<li class="page-item"><button class="page-link active" onclick="searchChangePage(' . $i . ')">' . $i . '</button></li>';
        } else {
            $html .= '<li class="page-item"><button class="page-link" onclick="searchChangePage(' . $i . ')">' . $i . '</button></li>';
        }
    }

    $html .= '  <li class="page-item">
                    <button class="page-link page-next" onclick="searchNextPage(' . $page_no . ', ' . $totalPages . ')">
                        <span class="material-symbols-outlined size-16 weight-600">arrow_forward_ios</span>
                    </button>
                </li>
            </ul>
        </div>';

    echo $html;
}
