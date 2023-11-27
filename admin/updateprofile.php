<!-- updateprofile.php -->

<?php
ob_start();
include("connect.php");
if ($_SESSION['name'] == '') {
    header("location:signin.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    // Add more fields as needed

    // Update the admin details in the database
    $query = "UPDATE admin_table SET name='$name', email='$email' WHERE id={$_SESSION['admin_id']}";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Update session variables with new details
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        // Update more session variables if needed

        header("Location: adminprofile.php");
    } else {
        echo "Error updating profile: " . mysqli_error($connection);
    }
}
?>