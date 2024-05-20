<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Complaint</title>

</head>

<body>
    <div class="container">
        <form action="add_complaint.php" method="post">
            <?php

            // Check if the session variable is set
            if (isset($_SESSION['u_email'])) {
                // If set, assign its value to the email input field
                $user_email = $_SESSION['u_email'];
                echo "<input type='email' name='email' placeholder='Enter your email' value='$user_email' readonly>";

            } else {
                // If not set, show a regular email input field
                echo "<input type='email' name='email' placeholder='Enter your email'>";
            }
            ?>
            <input type="text" name="complaint" placeholder="Enter your complaint">
            <input type="submit" name="submit" value="Submit">
        </form>
        <?php if (isset($_SESSION['u_email'])) {
            // If set, show the inbox button
            echo "<a href='inbox.php'><button>Inbox</button></a>";
        }
        ?>
    </div>
</body>

</html>

<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $complaint = $_POST['complaint'];
    $email = $_POST['email'];
    $query = "INSERT INTO complaint (complaint, u_email) VALUES ('$complaint', '$email')";
    $result = mysqli_query($connect, $query);
    if ($result) {
        // Start the session


        // Set the session variable
        $_SESSION['u_email'] = $email;

        echo "<script>window.location.href='add_complaint.php'</script>";
    } else {
        echo "Failed to add complaint";
    }
}
?>