<!-- editprofile.php -->

<?php
ob_start();
include("connect.php");
if ($_SESSION['name'] == '') {
    header("location:signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include necessary head content -->
</head>

<body>
    <nav>
        <!-- Include navigation content -->
    </nav>

    <section class="dashboard">
        <!-- Include dashboard content -->

        <div class="edit-profile">
            <div class="title">
                <i class="uil uil-user"></i>
                <span class="text">Edit Admin Profile</span>
            </div>

            <form action="updateprofile.php" method="post">
                <!-- Create a form to update admin details -->
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $_SESSION['name']; ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" required>

                <!-- Add more fields as needed -->

                <button type="submit">Update Profile</button>
            </form>
        </div>
    </section>
</body>

</html>