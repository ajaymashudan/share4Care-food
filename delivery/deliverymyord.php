<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start();

include '../connection.php';
include("connect.php");

// Check if the user is logged in
if (!isset($_SESSION['name']) || $_SESSION['name'] == '') {
    header("location:deliverylogin.php");
    exit();
}

$name = $_SESSION['name'];
$id = isset($_SESSION['Did']) ? $_SESSION['Did'] : ''; // Check if 'Did' exists in the session
$Did = isset($_POST['Did']) ? mysqli_real_escape_string($connection, $_POST['Did']) : ''; // Sanitize input

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="delivery.css">
    <link rel="stylesheet" href="../home.css">
</head>
<body>
<header>
    <div class="logo">Food <b style="color: #06C167;">Donate</b></div>
    <div class="hamburger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
    <nav class="nav-bar">
        <ul>
            <li><a href="delivery.php">Home</a></li>
            <li><a href="openmap.php">Map</a></li>
            <li><a href="deliverymyord.php" class="active">My Orders</a></li>
        </ul>
    </nav>
</header>
<br>
<script>
    const hamburger = document.querySelector(".hamburger");
    hamburger.onclick = function () {
        const navBar = document.querySelector(".nav-bar");
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
        font-size: 28px;
        color: black;
    }
    @media (max-width: 767px) {
        .itm img {
            width: 350px;
            height: 350px;
        }
    }
</style>

<div class="itm">
    <img src="../img/delivery.gif" alt="Delivery" width="400" height="400">
</div>

<div class="get">
    <?php
    // Define the SQL query to fetch orders assigned to the delivery person
    $sql = "SELECT fd.Fid AS Fid, fd.name, fd.phoneno, fd.date, fd.delivery_by, fd.address AS From_address, 
            ad.name AS delivery_person_name, ad.address AS To_address
            FROM food_donations fd
            LEFT JOIN admin ad ON fd.assigned_to = ad.Aid 
            WHERE fd.delivery_by = '$id'";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Check for errors
    if (!$result) {
        die("Error executing query: " . mysqli_error($connection));
    }

    // Fetch the data as an associative array
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // If the delivery person has taken an order, update the assigned_to field in the database
    if (isset($_POST['food']) && isset($_POST['delivery_person_id'])) {
        $order_id = mysqli_real_escape_string($connection, $_POST['order_id']);
        $delivery_person_id = mysqli_real_escape_string($connection, $_POST['delivery_person_id']);

        $update_sql = "UPDATE food_donations SET delivery_by = '$delivery_person_id' WHERE Fid = '$order_id'";
        $update_result = mysqli_query($connection, $update_sql);

        if (!$update_result) {
            die("Error assigning order: " . mysqli_error($connection));
        }

        // Reload the page to prevent duplicate assignments
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    }
    ?>
    <div class="log">
        <a href="delivery.php">Take Orders</a>
        <p>Order assigned to you</p>
        <br>
    </div>

    <!-- Display the orders in an HTML table -->
    <div class="table-container">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Date/Time</th>
                    <th>Pickup Address</th>
                    <th>Delivery Address</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $row) { ?>
                    <tr>
                        <td data-label="Name"><?php echo htmlspecialchars($row['name']); ?></td>
                        <td data-label="Phone No"><?php echo htmlspecialchars($row['phoneno']); ?></td>
                        <td data-label="Date/Time"><?php echo htmlspecialchars($row['date']); ?></td>
                        <td data-label="Pickup Address"><?php echo htmlspecialchars($row['From_address']); ?></td>
                        <td data-label="Delivery Address"><?php echo htmlspecialchars($row['To_address']); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<br><br>
</body>
</html>