<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Disease</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
    }

    form {
        max-width: 400px;
        margin: 0 auto;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Disease</h2>

        <?php
        // Include database connection
        include_once 'connect.php';

        // Check if ID parameter is provided in the URL
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            // Sanitize the input to prevent SQL injection
            $complaint_id = $_GET['id'];

            // Fetch the complaint record from the database
            $query = "SELECT * FROM complaint WHERE id = '$complaint_id'";
            $result = mysqli_query($connect, $query);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                ?>

        <!-- Display the edit form -->
        <form action="reply.php" method="POST">
            <input type="hidden" name="complaint_id" value="<?php echo $row['id']; ?>">

            <label for="name">Email:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['u_email']; ?>" required>

            <label for="complaint">Complaint:</label>
            <textarea id="complaint" name="complaint" rows="4" cols="50"
                required><?php echo $row['complaint']; ?></textarea>

            <label for="reply">Reply:</label>
            <textarea id="reply" name="reply" rows="4" cols="50" required><?php echo $row['reply']; ?></textarea>

            <input type="submit" name="update" value="Reply">
        </form>

        <?php
            } else {
                echo "Disease not found.";
            }
        } else {
            echo "Invalid request. Please provide a valid disease ID.";
        }

        mysqli_close($connect);
        ?>
    </div>
</body>

</html>