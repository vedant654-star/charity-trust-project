<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Database connection
include('db.php');

// Fetch counts for users, activities, and donations
$sql_users = "SELECT COUNT(*) AS total_users FROM users";
$result_users = mysqli_query($conn, $sql_users);
$total_users = $result_users ? mysqli_fetch_assoc($result_users)['total_users'] : 0;

$sql_activities = "SELECT COUNT(*) AS total_activities FROM activities";
$result_activities = mysqli_query($conn, $sql_activities);
$total_activities = $result_activities ? mysqli_fetch_assoc($result_activities)['total_activities'] : 0;

$sql_donations = "SELECT COUNT(*) AS total_donations FROM donations";
$result_donations = mysqli_query($conn, $sql_donations);
$total_donations = $result_donations ? mysqli_fetch_assoc($result_donations)['total_donations'] : 0;

mysqli_close($conn); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Charity Trust</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Charity Trust Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="manageActivities.php">Manage Recent Activities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manageDonations.php">Manage Donations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_registered_user.php">View Registered Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./payment.php">Payments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Admin Dashboard Content -->
    <div class="container mt-5">
        <h2>Welcome, <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Admin'; ?> (<?php echo $_SESSION['role']; ?>)</h2>
        <p>Welcome to the admin dashboard! Here you can manage recent activities, donations, and more.</p>

        <!-- Cards with Total Counts -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Registered Users</h5>
                        <p class="card-text"><?php echo $total_users; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Activities</h5>
                        <p class="card-text"><?php echo $total_activities; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Total Donations</h5>
                        <p class="card-text"><?php echo $total_donations; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Dashboard Functionalities -->
        
    <!-- Bootstrap JS & jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
