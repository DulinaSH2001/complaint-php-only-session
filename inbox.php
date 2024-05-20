<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    
</head>

<body>
    <div class="container">
        <?php
        // Start the session
        session_start();

        include 'connect.php';

        // Check if the user is logged in (i.e., if the session variable is set)
        if (!isset($_SESSION['u_email'])) {
            // If the user is not logged in, redirect them to the login page
            header("Location: login.php");
            exit();
        } else {
            echo "<h2>Welcome " . $_SESSION['u_email'] . "</h2>";

            // Get the user's email from the session
            $user_email = $_SESSION['u_email'];

            // Retrieve all complaints for the logged-in user from the database
            $query = "SELECT * FROM complaint WHERE u_email = '$user_email'";
            $result = mysqli_query($connect, $query);

            // Check if there are any complaints for the logged-in user
            if (mysqli_num_rows($result) > 0) {
                // Display each complaint and its corresponding reply (if any)
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='complaint'>";
                    echo "<p>Email: " . $row['u_email'] . "</p>";
                    echo "<p>Complaint: " . $row['complaint'] . "</p>";
                    if (!empty($row['reply'])) {
                        echo "<p class='reply'>Reply: " . $row['reply'] . "</p>";
                    } else {
                        echo "<p class='reply'>No reply</p>";
                    }
                    echo "</div>";
                }
            } else {
                // If no complaints are found for the logged-in user, display a message
                echo "<p>No complaints found for this user.</p>";
            }

            // Close the database connection
            mysqli_close($connect);
        }
        ?>
    </div>
</body>

</html>