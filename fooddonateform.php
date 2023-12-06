<?php
include("login.php");
if ($_SESSION['name'] == '') {
    header("location: signin.php");
}

$emailid = $_SESSION['email'];
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'feed-the-hungry-hub');
if (isset($_POST['submit'])) {
    $foodname = mysqli_real_escape_string($connection, $_POST['foodname']);
    $meal = mysqli_real_escape_string($connection, $_POST['meal']);
    $category = $_POST['image-choice'];
    $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);
    $phoneno = mysqli_real_escape_string($connection, $_POST['phoneno']);
    $city = mysqli_real_escape_string($connection, $_POST['city']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);

    $query = "insert into food_donations(email,food,type,category,phoneno,location,address,name,quantity) values('$emailid','$foodname','$meal','$category','$phoneno','$city','$address','$name','$quantity')";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        echo '<script type="text/javascript">alert("data saved")</script>';
        header("location:delivery.html");
    } else {
        echo '<script type="text/javascript">alert("data not saved")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed-The-Hungry-Hub</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body style="background-color: #5b92e5;">

    <header>
        <div class="logo"> <b style="color: #062bc1;"> Feed </b> The <b style="color: #4565e6;"> Hungry </b> Hub </div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>

        <nav class="nav-bar">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="home.html#about-us">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="fooddonateform.php" class="active">Donate</a></li>
                <li><a href="profile.php">Profile</a></li>
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

    <script>
        function scrollToAbout() {
            var aboutSection = document.getElementById("about-us");
            aboutSection.scrollIntoView({ behavior: 'smooth' });
        }
    </script>

    <!-- <div class="container" style="max-width: 800px; margin: 0 auto; display: flex; justify-content: space-between;">
        <div class="regformf" style="width: 48%; box-sizing: border-box; padding: 20px;">
            <form action="" method="post">
            <div class="input">
                    <label for="foodname"> Food Name:</label>
                    <input type="text" id="foodname" name="foodname" required />
                </div>

                <div class="radio">
                    <label for="meal">Meal type :</label>
                    <br><br>

                    <input type="radio" name="meal" id="veg" value="veg" required />
                    <label for="veg" style="padding-right: 40px;">Veg</label>
                    <input type="radio" name="meal" id="Non-veg" value="Non-veg">
                    <label for="Non-veg">Non-veg</label>

                </div>
                <br>
                <div class="input">
                    <label for="food">Select the Category:</label>
                    <br><br>
                    <div class="image-radio-group">
                        <input type="radio" id="raw-food" name="image-choice" value="raw-food">
                        <label for="raw-food">
                            <img src="img/raw-food.png" alt="raw-food">
                        </label>
                        <input type="radio" id="cooked-food" name="image-choice" value="cooked-food" checked>
                        <label for="cooked-food">
                            <img src="img/cooked-food.png" alt="cooked-food">
                        </label>
                        <input type="radio" id="packed-food" name="image-choice" value="packed-food">
                        <label for="packed-food">
                            <img src="img/packed-food.png" alt="packed-food">
                        </label>
                    </div>
                    <br>
                </div>
                <div class="input">
                    <label for="quantity">Quantity:(number of person /kg)</label>
                    <input type="text" id="quantity" name="quantity" required />
                </div>
            </form>
        </div>
        <div class="regformf" style="width: 48%; box-sizing: border-box; padding: 20px;">
            <form action="" method="post">
            <div class="input">
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo "" . $_SESSION['name']; ?>"
                            required />
                    </div>
                    <div>
                        <label for="phoneno">PhoneNo:</label>
                        <input type="text" id="phoneno" name="phoneno" maxlength="10" pattern="[0-9]{10}" required />
                    </div>
                </div>
                <div class="input">
                    <label for="location"></label>
                    <label for="city">City:</label>
                    <select id="city" name="city" style="padding: 10px;">
                        <option value="hyderabad">Hyderabad</option>
                        <option value="secunderabad">Secunderabad</option>
                        <option value="warangal">Warangal</option>
                        <option value="nizamabad">Nizamabad</option>
                        <option value="karimnagar">Karimnagar</option>
                        <option value="khammam">Khammam</option>
                        <option value="ramagundam">Ramagundam</option>
                        <option value="mahbubnagar">Mahbubnagar</option>
                        <option value="suryapet">Suryapet</option>
                        <option value="siddipet">Siddipet</option>
                        <!-- Add more cities as needed -->
                    </select>

                    <!-- <select id="district" name="district" style="padding:10px;">
                        <option value="adilabad">Adilabad</option>
                        <option value="bhupalpally">Bhupalpally</option>
                        <option value="jagtial">Jagtial</option>
                        <option value="jangaon">Jangaon</option>
                        <option value="jayashankar">Jayashankar</option>
                        <option value="kamareddy">Kamareddy</option>
                        <option value="karimnagar">Karimnagar</option>
                        <option value="khammam">Khammam</option>
                        <option value="komaram-bheem">Komaram Bheem</option>
                        <option value="mahabubabad">Mahabubabad</option>
                        <option value="mahabubnagar">Mahabubnagar</option>
                        <option value="mancherial">Mancherial</option>
                        <option value="medak">Medak</option>
                        <option value="medchal">Medchal</option>
                        <option value="nagarkurnool">Nagarkurnool</option>
                        <option value="nalgonda">Nalgonda</option>
                        <option value="nirmal">Nirmal</option>
                        <option value="nizamabad">Nizamabad</option>
                        <option value="peddapalli">Peddapalli</option>
                        <option value="rajanna-sircilla">Rajanna Sircilla</option>
                        <option value="ranga-reddy">Ranga Reddy</option>
                        <option value="sangareddy">Sangareddy</option>
                        <option value="siddipet">Siddipet</option>
                        <option value="suryapet">Suryapet</option>
                        <option value="vikarabad">Vikarabad</option>
                        <option value="wanaparthy">Wanaparthy</option>
                        <option value="warangal-rural">Warangal Rural</option>
                        <option value="warangal-urban">Warangal Urban</option>
                        <option value="yadadri-bhuvanagiri">Yadadri Bhuvanagiri</option>
                    </select> -->
<!-- 
                    <label for="address" style="padding-left: 10px;">Address:</label>
                    <input type="text" id="address" name="address" required /><br>
                </div>
            </form>
        </div>
    </div>
    <div style="text-align: center;">
        <button type="submit" name="submit">Submit</button>
    </div> --> 


    <div class="container" style="max-width: px; margin: 0 auto;">
        <div class="regformf" style="width: 800px; box-sizing: border-box; padding: 20px;">
            <form action="" method="post" style="width: 700px;">
                <p class="logo"><b style="color: #062bc1;"> Feed </b> The <b style="color: #4565e6;"> Hungry </b> Hub
                </p>

                <div class="input">
                    <label for="foodname"> Food Name:</label>
                    <input type="text" id="foodname" name="foodname" required />
                    <br>
                </div>

                <div class="radio">
                    <label for="meal">Meal type : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="radio" name="meal" id="veg" value="veg" required />
                    <label for="veg" style="padding-right: 40px;">Veg</label>
                    <input type="radio" name="meal" id="Non-veg" value="Non-veg">
                    <label for="Non-veg">Non-veg</label>

                </div>
                <br>
                <div class="input">
                    <label for="food">Select the Category:</label>
                    <br><br>
                    <div class="image-radio-group">
                        <input type="radio" id="raw-food" name="image-choice" value="raw-food">
                        <label for="raw-food">
                            <img src="img/raw-food.jpg" alt="raw-food">
                        </label>
                        <input type="radio" id="cooked-food" name="image-choice" value="cooked-food">
                        <label for="cooked-food">
                            <img src="img/cooked-food.jpg" alt="cooked-food">
                        </label>
                        <input type="radio" id="packed-food" name="image-choice" value="packed-food">
                        <label for="packed-food">
                            <img src="img/packed-food.jpg" alt="packed-food">
                        </label>
                    </div>
                    <br>
                </div>
                <div class="input">
                    <label for="quantity">Quantity: (Count / Quantity in kg)</label>
                    <input type="text" id="quantity" name="quantity" required />
                </div>
                <b>
                    <p style="text-align: center; text-decoration: underline;"> <u>Contact Details</u> </p>
                </b>
                <div class="input">
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo "" . $_SESSION['name']; ?>" required />
                    </div>
                    <div>
                        <label for="phoneno">PhoneNo:</label>
                        <input type="text" id="phoneno" name="phoneno" maxlength="10" pattern="[0-9]{10}" required />
                    </div>
                </div>
                <div class="input">
                    <label for="location"></label>
                    <label for="city">City: </label>
                    <select id="city" name="city" style="padding: 10px; width: 700px; height: 60px; border-radius: 5px; font-size: 16px;">
                        <option value="hyderabad">Hyderabad</option>
                        <option value="secunderabad">Secunderabad</option>
                        <option value="warangal">Warangal</option>
                        <option value="nizamabad">Nizamabad</option>
                        <option value="karimnagar">Karimnagar</option>
                        <option value="khammam">Khammam</option>
                        <option value="ramagundam">Ramagundam</option>
                        <option value="mahbubnagar">Mahbubnagar</option>
                        <option value="suryapet">Suryapet</option>
                        <option value="siddipet">Siddipet</option>
                        <!-- Add more cities as needed -->
                    </select>

                    <!-- <select id="district" name="district" style="padding:10px;">
                        <option value="adilabad">Adilabad</option>
                        <option value="bhupalpally">Bhupalpally</option>
                        <option value="jagtial">Jagtial</option>
                        <option value="jangaon">Jangaon</option>
                        <option value="jayashankar">Jayashankar</option>
                        <option value="kamareddy">Kamareddy</option>
                        <option value="karimnagar">Karimnagar</option>
                        <option value="khammam">Khammam</option>
                        <option value="komaram-bheem">Komaram Bheem</option>
                        <option value="mahabubabad">Mahabubabad</option>
                        <option value="mahabubnagar">Mahabubnagar</option>
                        <option value="mancherial">Mancherial</option>
                        <option value="medak">Medak</option>
                        <option value="medchal">Medchal</option>
                        <option value="nagarkurnool">Nagarkurnool</option>
                        <option value="nalgonda">Nalgonda</option>
                        <option value="nirmal">Nirmal</option>
                        <option value="nizamabad">Nizamabad</option>
                        <option value="peddapalli">Peddapalli</option>
                        <option value="rajanna-sircilla">Rajanna Sircilla</option>
                        <option value="ranga-reddy">Ranga Reddy</option>
                        <option value="sangareddy">Sangareddy</option>
                        <option value="siddipet">Siddipet</option>
                        <option value="suryapet">Suryapet</option>
                        <option value="vikarabad">Vikarabad</option>
                        <option value="wanaparthy">Wanaparthy</option>
                        <option value="warangal-rural">Warangal Rural</option>
                        <option value="warangal-urban">Warangal Urban</option>
                        <option value="yadadri-bhuvanagiri">Yadadri Bhuvanagiri</option>
                    </select> -->
                    <br><br>
                    <label for="address" >Address:</label>
                    <input type="text" id="address" name="address" required /><br>
                </div>
                <div class="btn">
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>
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