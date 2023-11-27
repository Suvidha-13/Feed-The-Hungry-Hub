<?php
include '../connection.php';
include("connect.php");

// Check if the user is logged in
if ($_SESSION['name'] == '') {
    header("location:signin.php");
    exit; // Ensure to stop script execution after redirect
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert the data into the 'user_feedback' table
    $insertQuery = "INSERT INTO user_feedback (name, email, message) VALUES ('$name', '$email', '$message')";
    $insertResult = mysqli_query($connection, $insertQuery);

    if ($insertResult) {
        // Insertion successful, set a variable for success message
        $successMessage = "Feedback submitted successfully!";
    } else {
        // Insertion failed, set a variable for error message
        $errorMessage = "Error submitting feedback: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="admin.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>

    <?php
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, 'feed-the-hungry-hub');
    ?>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <!--<img src="images/logo.png" alt="">-->
            </div>

            <span class="logo_name">ADMIN</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="admin.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <!-- <li><a href="#">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Content</span>
                    </a></li> -->
                <li><a href="analytics.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Analytics</span>
                    </a></li>
                <li><a href="donate.php">
                        <i class="uil uil-heart"></i>
                        <span class="link-name">Donates</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-comments"></i>
                        <span class="link-name">Feedbacks</span>
                    </a></li>
                <li><a href="adminprofile.php">
                        <i class="uil uil-clock"></i>
                        <span class="link-name">Donations History</span>
                    </a></li>
                <li><a href="profile.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Profile</span>
                    </a></li>
                <!-- <li><a href="#">
                        <i class="uil uil-share"></i>
                        <span class="link-name">Share</span>
                    </a></li> -->
            </ul>

            <ul class="logout-mode">
                <li><a href="../logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <!-- <p>Food Donate</p> -->
            <p class="logo">Feed<b style="color: #4169e1; ">back</b></p>
            <p class="user"></p>
            <!-- <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div> -->

            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        <br>
        <br>
        <br>

        <div class="activity">
            <div class="table-container">
                <div class="table-wrapper">
                    <!-- Display success or error message if set -->
                    <?php if (isset($successMessage)): ?>
                        <div class="success-message">
                            <?php echo $successMessage; ?>
                        </div>
                    <?php elseif (isset($errorMessage)): ?>
                        <div class="error-message">
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php endif; ?>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>email</th>
                                <th>message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM user_feedback";
                            $result = mysqli_query($connection, $query);

                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td data-label=\"name\">" . $row['name'] . "</td><td data-label=\"email\">" . $row['email'] . "</td><td data-label=\"message\">" . $row['message'] . "</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script src="admin.js"></script>
</body>

</html>