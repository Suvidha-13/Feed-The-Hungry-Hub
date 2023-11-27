<?php
ob_start();
include("connect.php");
include '../connection.php';

// Start the session
// session_start();

if (!isset($_SESSION['name']) || $_SESSION['name'] == '') {
    header("location:deliverylogin.php");
}

// Make sure 'Did' key is set in the $_SESSION array
if (!isset($_SESSION['Did'])) {
    // You may set a default value or redirect the user to a page where 'Did' is set
    $_SESSION['Did'] = 'DefaultDid';
}

$name = $_SESSION['name'];
$city = $_SESSION['city'];
$id = $_SESSION['Did']; // Now it's safe to access 'Did'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed-The-Hungry-Hub</title>
    <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="delivery.css">
</head>

<body>
    <header>
        <div class="logo"><b style="color: #062bc1; ">Feed</b>-The-<b style="color: #062bc1; ">Hungry</b>-Hub</div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="openmap.php">map</a></li>
                <li><a href="deliverymyord.php">myorders</a></li>
            </ul>
        </nav>
    </header>
    <br>
    <script>
        hamburger = document.querySelector(".hamburger");
        hamburger.onclick = function () {
            navBar = document.querySelector(".nav-bar");
            navBar.classList.toggle("active");
        }
    </script>

    <style>
        .itm {
            background-color: white;
            display: grid;
        }

        .itm img {
            width: 400px;
            height: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        p {
            text-align: center;
            font-size: 30PX;
            color: black;
            margin-top: 50px;
        }

        a {
            /* text-decoration: underline; */
        }

        @media (max-width: 767px) {
            .itm img {
                width: 350px;
                height: 350px;
            }
        }
    </style>
    <h2>
        <center>Welcome
            <?php echo "$name"; ?>
        </center>
    </h2>

    <div class="itm">
        <img src="../img/delivery.gif" alt="" width="400" height="400">
    </div>

    <div class="get">
        <div class="log">
            <a href="deliverymyord.php">My orders</a>
        </div>

        <?php
        $sql = "SELECT fd.Fid AS Fid, fd.location as cure, fd.name, fd.phoneno, fd.date, fd.delivery_by, fd.address as From_address,
                ad.name AS delivery_person_name, ad.address AS To_address
                FROM food_donations fd
                LEFT JOIN admin ad ON fd.assigned_to = ad.Aid
                WHERE assigned_to IS NOT NULL AND delivery_by IS NULL AND fd.location=?";

        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $city);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die("Error executing query: " . mysqli_error($connection));
        }

        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        if (isset($_POST['food']) && isset($_POST['delivery_person_id'])) {
            $order_id = $_POST['order_id'];
            $delivery_person_id = $_POST['delivery_person_id'];

            $sql = "SELECT * FROM food_donations WHERE Fid = ? AND delivery_by IS NOT NULL";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, "i", $order_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                die("Sorry, this order has already been assigned to someone else.");
            }

            $sql = "UPDATE food_donations SET delivery_by = ? WHERE Fid = ?";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, "ii", $delivery_person_id, $order_id);
            mysqli_stmt_execute($stmt);

            if (!$stmt) {
                die("Error assigning order: " . mysqli_error($connection));
            }

            header('Location: ' . $_SERVER['REQUEST_URI']);
            ob_end_flush();
        }
        ?>

        <div class="table-container">
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>phoneno</th>
                            <th>date/time</th>
                            <th>Pickup address</th>
                            <th>Delivery Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) { ?>
                            <?php echo "<tr><td data-label=\"name\">" . $row['name'] . "</td><td data-label=\"phoneno\">" . $row['phoneno'] . "</td><td data-label=\"date\">" . $row['date'] . "</td><td data-label=\"Pickup Address\">" . $row['From_address'] . "</td><td data-label=\"Delivery Address\">" . $row['To_address'] . "</td>"; ?>
                            <td data-label="Action" style="margin:auto">
                                <?php if ($row['delivery_by'] == null) { ?>
                                    <form method="post" action=" ">
                                        <input type="hidden" name="order_id" value="<?= $row['Fid'] ?>">
                                        <input type="hidden" name="delivery_person_id" value="<?= $id ?>">
                                        <button type="submit" name="food">Take order</button>
                                    </form>
                                <?php } else if ($row['delivery_by'] == $id) { ?>
                                        Order assigned to you
                                <?php } else { ?>
                                        Order assigned to another Volunteer
                                <?php } ?>
                            </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <br>
            <br>
        </div>
    </div>
</body>

</html>