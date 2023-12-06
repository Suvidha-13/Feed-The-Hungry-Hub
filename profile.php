<?php
include("login.php");
if ($_SESSION['name'] == '') {
    header("location: signup.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed-The-Hungry-Hub</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <header>
        <div class="logo"><b style="color: #062bc1;">Feed</b> The <b style="color: #4565e6;">Hungry</b> Hub </div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="fooddonateform.php">Donate</a></li>
                <li><a href="profile.php" class="active">Profile</a></li>
            </ul>
        </nav>
    </header>
    <script>
        hamburger = document.querySelector(".hamburger");
        hamburger.onclick = function () {
            navBar = document.querySelector(".nav-bar");
            navBar.classList.toggle("active");
        }
    </script>

    <div class="profile">
        <div class="profilebox" style="">

            <p class="headingline" style="text-align: left;font-size:30px;"> <img src="" alt=""
                    style="width:40px; height:  height: 25px;; padding-right: 10px; position: relative;">Profile</p>
            <!--             
            <img src="user.png" alt="" style="  width: 90px;
            height: 90px;
            /* border-radius:50% ;  */
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding-top: 10px;
             /* border: 1px solid #06C167; */
            ">
            <br> -->
            <!-- <p style="font-size: 28px;">welcome</p> -->
            <!-- <p style="color: #06C167;">username</p> -->
            <br>
            <div class="info" style="padding-left:10px;">
                <p style="">Name :
                    <?php echo "" . $_SESSION['name']; ?>
                </p><br>
                <p style="">Email :
                    <?php echo "" . $_SESSION['email']; ?>
                </p><br>
                <p style="">Gender:
                    <?php echo "" . $_SESSION['gender']; ?>
                </p><br>
                <!-- <p style="font-family: 'Times New Roman', Times, serif;">gender  :<?php echo "" . $_SESSION['gender']; ?> </p><br>  -->

                <a href="logout.php"
                    style="float: left;margin-top: 6px ;border-radius:5px; background-color: #4565e6; color: white;padding: ;padding-left: 10px;padding-right: 10px;">Logout</a>
            </div>
            <br>
            <br>
            <hr>
            <br>
            <p class="heading">Your donations</p>
            <!-- <p class="" style="font-family: 'Times New Roman', Times, serif; font-size: 20px;">Your donations</p><br> -->
            <!-- <img src="profilecover1.jpg" alt="" width='100%' height='auto'> -->
            <div class="table-container">
                <!-- <p id="heading">donated</p> -->
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>food</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>date/time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $email = $_SESSION['email'];
                            $query = "select * from food_donations where email='$email'";
                            $result = mysqli_query($connection, $query);
                            if ($result == true) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['food'] . "</td><td>" . $row['type'] . "</td><td>" . $row['category'] . "</td><td>" . $row['date'] . "</td></tr>";
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-left col-md-4 col-sm-6">
            <p class="about">
                <span> About us</span>The primary objective of this project is to minimize food wastage while ensuring
                that the needy have access to nourishing meals. We believe in harnessing
                technology for the betterment of society, and this project serves as an
                embodiment of that belief.
            </p>
        </div>


        <div class="footer-center col-md-4 col-sm-6">
            <div>
                <p><span> Contact</span> </p>

            </div>
            <div>

                <p> (+91) 123 456 7890</p>

            </div>
            <div>
                <p><a href="mailto:feedthehungryhub@gmail.com">feedthehungryhub@gmail.com</a></p>
            </div>

            <div class="sociallist">
                <ul class="social">
                    <li><a href="https://www.facebook.com"><i class="fa-brands fa-facebook" style="font-size:50px;color: black;"></i></a></li>
                    <li><a href="https://twitter.com"><i class="fa-brands fa-x-twitter" style="font-size:50px;color: black;"></i></a></li>
                    <li><a href="https://www.instagram.com"><i class="fa-brands fa-instagram" style="font-size:50px;color: black;"></i></a></li>
                    <li><a href="https://web.whatsapp.com/"><i class="fa-brands fa-whatsapp" style="font-size:50px;color: black;"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-right col-md-4 col-sm-6">
            <h2>
                <span1>Feed</span1>The<span>Hungry</span>Hub
            </h2>
            <p class="menu">
                <a href="#"> Home</a> |
                <a href="about.html"> About</a> |
                <a href="profile.php"> Profile</a> |
                <a href="contact.html"> Contact</a>
            </p>
        </div>
    </footer>
</body>

</html>