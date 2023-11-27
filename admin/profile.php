<!-- adminprofile.php -->

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="admin.css">

    <style>
        .dashboard {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            /* Align everything to the left */
        }


        .dash-content {
            width: 100%;
            display: flex;
            justify-content: flex-start;
            /* Align content to the left */
            align-items: flex-start;
            /* Align items to the left */
            margin-top: 20px;
        }

        .profile {
            width: 50%;
        }

        .profile-details {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
            text-align: left;
            margin: 20px;
        }

        .profile-details p {
            font-size: 18px;
            margin: 10px 0;
        }

        .profile-details a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .profile-details a:hover {
            background-color: #0056b3;
        }
    </style>

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Profile</title>

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
                <li><a href="feedback.php">
                        <i class="uil uil-comments"></i>
                        <span class="link-name">Feedbacks</span>
                    </a></li>
                <li><a href="adminprofile.php">
                        <i class="uil uil-clock"></i>
                        <span class="link-name">Donations History</span>
                    </a></li>
                <li><a href="#">
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
            <p class="logo"><b style="color: #062bc1;"> Feed </b> The <b style="color: #4565e6;"> Hungry </b> Hub </p>
            <p class="user"></p>
            <!-- <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div> -->

            <!--<img src="images/profile.jpg" alt="">-->
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-user"></i>
                    <span class="text">My Profile</span>
                </div>

            </div>




            <!-- 
                <div class="table-container">
         <p id="heading">donated</p>
         <div class="table-wrapper">
        <table class="table">
        <thead>
        <tr>
            <th >Name</th>
            <th>food</th>
            <th>Category</th>
            <th>phoneno</th>
            <th>date/time</th>
            <th>address</th>
            <th>Quantity</th>
            <th>Status</th>
          
           
        </tr>
        </thead>
       <tbody>
   
         <?php
         $loc = $_SESSION['location'];
         $query = "select * from food_donations where location='$loc' ";
         $result = mysqli_query($connection, $query);
         if ($result == true) {
             while ($row = mysqli_fetch_assoc($result)) {
                 echo "<tr><td data-label=\"name\">" . $row['name'] . "</td><td data-label=\"food\">" . $row['food'] . "</td><td data-label=\"category\">" . $row['category'] . "</td><td data-label=\"phoneno\">" . $row['phoneno'] . "</td><td data-label=\"date\">" . $row['date'] . "</td><td data-label=\"Address\">" . $row['address'] . "</td><td data-label=\"quantity\">" . $row['quantity'] . "</td><td  data-label=\"Status\" >" . $row['quantity'] . "</td></tr>";

             }

         } else {
             echo "<p>No results found.</p>";
         }

         ?> 
    
        </tbody>
    </table>
         </div>
                </div>
                
          -->

        </div>

        <div class="profile">

            <div class="profile-details">
                <!-- Display admin details here -->
                <p>Name:
                    <?php echo $_SESSION['name']; ?>
                </p>
                <p>Email:
                    <?php echo $_SESSION['email']; ?>
                </p>
                <!-- Add more details as needed -->

                <a href="editprofile.php">Edit Profile</a>
            </div>
        </div>
    </section>

    <script src="admin.js"></script>
</body>

</html>