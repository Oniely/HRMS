<?php

include_once "./connection.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        $sql =
            "SELECT employee_id AS id, fname, mname, lname, 'employee' AS type
                FROM employee_tbl
                WHERE fname LIKE '%$keyword%' 
                OR lname LIKE '%$keyword%' 
                OR mname LIKE '%$keyword%'
                OR employee_id LIKE '%$keyword%'
            UNION
            SELECT faculty_id AS id, fname, mname, lname, 'faculty' AS type
                FROM faculty_tbl
                WHERE fname LIKE '%$keyword%' 
                OR lname LIKE '%$keyword%' 
                OR mname LIKE '%$keyword%'
                OR faculty_id LIKE '%$keyword%'";

        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

        if ($result) {
            foreach ($result as $row) {
                if ($row['type'] === 'employee') {
                    echo "<a href='about_staff.php?id={$row['id']}' class='search-result-link'>{$row['fname']} {$row['mname']} {$row['lname']} - {$row['id']}</a>";
                } else {
                    echo "<a href='about_faculty.php?faculty_id={$row['id']}' class='search-result-link'>{$row['fname']} {$row['mname']} {$row['lname']} - {$row['id']}</a>";
                }
            }
        } else {
            echo "<p class='search-result-link'>No results found.</p>";
        }
    }
}
