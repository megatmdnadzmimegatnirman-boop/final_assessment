<?php

include "db.php";
include "auth.php";

$search = trim($_GET['search'] ?? '');
$like = "%$search%";


if ($search !== '') {
    $sql = $conn->prepare(
        "SELECT * FROM results
         WHERE student_name LIKE ?
            OR matric_number LIKE ?
            OR subject_code LIKE ?
            OR subject_name LIKE ?"
    );
    $sql->bind_param("ssss", $like, $like, $like, $like);
} else {
    $sql = $conn->prepare("SELECT * FROM results");
 }
$sql->execute();

$result = $sql->get_result();

include "header.php";

$search = trim($_GET['search'] ?? '');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Assessment - Grading System</title>
</head>

<body>

    <h2>Student Records</h2>

    <a href="add.php">+ Add Result</a>

    <form method="get" action="index.php">
        <input type="text" name="search" placeholder="Search by name or id">
        <button type="submit">Search</button>

    <a href="index.php">Show all</a>

    <br><br>

    <div>

        <table border="5" cellspacing="0" cellpadding="7">

            <tr>
                <th>No.</th>
                <th>Student Name</th>
                <th>Matric No.</th>
                <th>Subject</th>
                <th>Test 1 (20%)</th>
                <th>Test 2 (30%)</th>
                <th>Final (50%)</th>
                <th>Total (100%)</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>

            <?php

            $no=1;
            while ($row = $result->fetch_assoc()) {

                echo "<tr>";

                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['student_name'] . "</td>";
                echo "<td>" . $row['matric_number'] . "</td>";
                echo "<td>" . $row['subject_name'] . "</td>";
                echo "<td>" . $row['test1'] . "</td>";
                echo "<td>" . $row['test2'] . "</td>";
                echo "<td>" . $row['final'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";
                echo "<td>" . $row['grade'] . "</td>";
                echo "<td>";

                echo "<button><a href='edit.php?id=" . $row['id'] . "'>Edit</a></button>";

                echo "<form method='post' action = 'delete.php' onsubmit='return confirm(\"Are you sure you want to delete this record?\")'>"; 
                echo "<input type='hidden' name='delete' value='" . $row['id'] . "'>";
                echo "<button type='submit'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";

            }

            ?>

        </table>

    </div>

</body>

</html>