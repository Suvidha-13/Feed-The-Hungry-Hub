<?php
// session_start();
// $connection=mysqli_connect("localhost:3307","root","");
// $db=mysqli_select_db($connection,'demo');
include '../connection.php';
$msg = 0;
if (isset($_POST['sign'])) {

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $location = $_POST['district'];

  // $location=$_POST['district'];

  $pass = password_hash($password, PASSWORD_DEFAULT);
  $sql = "select * from delivery_persons where email='$email'";
  $result = mysqli_query($connection, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    // echo "<h1> already account is created </h1>";
    // echo '<script type="text/javascript">alert("already Account is created")</script>';
    echo "<h1><center>Account already exists</center></h1>";
  } else {

    $query = "insert into delivery_persons(name,email,password,city) values('$username','$email','$pass','$location')";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
      // $_SESSION['email']=$email;
      // $_SESSION['name']=$row['name'];
      // $_SESSION['gender']=$row['gender'];

      header("location:delivery.php");
      // echo "<h1><center>Account does not exists </center></h1>";
      //  echo '<script type="text/javascript">alert("Account created successfully")</script>'; -->
    } else {
      echo '<script type="text/javascript">alert("data not saved")</script>';

    }
  }

}
?>


<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Feed-The-Hungry-Hub | Login Form</title>
  <link rel="stylesheet" href="deliverycss.css">
</head>

<body>
  <div class="center">
    <h1>Register</h1>
    <form method="post" action=" ">
      <div class="txt_field">
        <input type="text" name="username" required />
        <span></span>
        <label>Username</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" required />
        <span></span>
        <label>Password</label>
      </div>
      <div class="txt_field">
        <input type="email" name="email" required />
        <span></span>
        <label>Email</label>
      </div>
      <div class="">
        <!-- <label for="district">District:</label> -->
        <select id="district" name="district" style="padding:10px; padding-left: 20px;">
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
        </select>
      </div>

      <br>
      <!-- <div class="pass">Forgot Password?</div> -->
      <input type="submit" name="sign" value="Register">
      <div class="signup_link">
        Alredy a member? <a href="deliverylogin.php">Sigin</a>
      </div>
    </form>
  </div>

</body>

</html>