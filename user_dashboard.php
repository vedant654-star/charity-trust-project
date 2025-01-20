<?php
session_start();

// Check if the user is logged in as a regular user
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header('Location: login.php');
    exit();
}

// Database connection
include('db.php');

// Fetch user-specific data if needed (example: user's donation history or activities)
$user_id = $_SESSION['user_id']; // Assuming the user's ID is stored in the session
$sql_donations = "SELECT COUNT(*) AS total_donations FROM donations WHERE user_id = $user_id";
$result_donations = mysqli_query($conn, $sql_donations);
$total_donations = mysqli_fetch_assoc($result_donations)['total_donations'];

$sql_activities = "SELECT COUNT(*) AS total_activities FROM activities WHERE user_id = $user_id";
$result_activities = mysqli_query($conn, $sql_activities);
$total_activities = mysqli_fetch_assoc($result_activities)['total_activities'];

mysqli_close($conn); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Charity Trust</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Charity Trust User</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="view_activities.php">View Activities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my_donations.php">My Donations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- User Dashboard Content -->
    <div class="container mt-5">
        <h2>Welcome, <?php echo $_SESSION['name']; ?> (<?php echo $_SESSION['role']; ?>)</h2>
        <p>Welcome to your dashboard! Here you can view your activities, donations, and manage your profile.</p>

        <!-- Cards with User-Specific Data -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Your Total Donations</h5>
                        <p class="card-text"><?php echo $total_donations; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Your Total Activities</h5>
                        <p class="card-text"><?php echo $total_activities; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional User-Specific Content -->
        <div class="mt-4">
            <h4>Your Recent Activities</h4>
            <p>Check out your contributions and ongoing projects. Visit the <a href="recentActivities.php">Activities</a> page for details.</p>
        </div>
    </div>

    <!-- Bootstrap JS & jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
