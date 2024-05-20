<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Complaints</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f5f5f5;
    }

    td button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        padding: 5px 10px;
        text-decoration: none;
    }

    td button:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>All Complaints</h2>
        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Complaint</th>
                    <th>Reply</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connect.php';

                // Retrieve all complaints from the database
                $query = "SELECT * FROM complaint";
                $result = mysqli_query($connect, $query);

                // Check if there are any complaints
                if (mysqli_num_rows($result) > 0) {
                    // Display each complaint in a table row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['u_email'] . "</td>";
                        echo "<td>" . $row['complaint'] . "</td>";
                        // Check if the reply field is empty
                        if (!empty($row['reply'])) {
                            echo "<td>" . $row['reply'] . "</td>";
                        } else {
                            echo "<td><button><a href='reply_complaint.php?id=" . $row['id'] . "'>Reply</a></button></td>";
                        }
                        // Add delete button in the action column
                        echo "<td>";
                        echo "<form action='manage_complaint.php' method='POST'>";
                        echo "<input type='hidden' name='complaint_id' value='" . $row['id'] . "'>";
                        echo "<input type='submit' name='delete' value='Delete'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No complaints found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
include_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {

    $complaint_id = $_POST['complaint_id'];


    $query = "DELETE FROM complaint WHERE id = '$complaint_id'";

    if (mysqli_query($connect, $query)) {

        header("Location: manage_complaint.php");
        exit();
    } else {

        echo "Error deleting record: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
?>