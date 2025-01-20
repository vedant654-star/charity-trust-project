<?php
include('db.php');

// Fetch recent activities
$sql = "SELECT * FROM activities ORDER BY date DESC LIMIT 5";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Trust</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            margin-bottom: 30px;
        }

        .hero-section {
            background-image: url('data:image/jpeg;base64,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');
            background-size: cover;
            color: white;
            text-align: center;
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin: 40px 0;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
        }

        .footer .fa {
            margin-right: 15px;
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Charity Trust</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 text-dark">Welcome to Charity Trust</h1>
            <p  class="text-dark">Your donations help us make a difference in the world. Together, we can bring hope and change lives.</p>
            <a href="donation.php" class="btn btn-dark btn-lg">Donate Now</a>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="container my-5">
        <h2 class="section-title">About Us</h2>
        <p>Charity Trust is a non-profit organization dedicated to making a positive impact in the lives of those in need.
            Your donations go towards helping underprivileged communities, providing food, shelter, education, and healthcare.
            We are committed to transparency and ensuring that every penny counts.</p>
    </section>

    <!-- Recent Activities Section -->
            <section class="my-5 text-center py-5">
            <h2>Recent Activities</h2>
            <ul class="list-group">
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <li class="list-group-item">
                        <h5><?php echo $row['title']; ?></h5>
                        <p><?php echo $row['description']; ?></p>
                        <small>Posted on: <?php echo $row['date']; ?></small>
                    </li>
                <?php } ?>
            </ul>
        </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Quick Links -->
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white">Home</a></li>
                        <li><a href="donation.php" class="text-white">Donate</a></li>
                        <li><a href="#about" class="text-white">About Us</a></li>
                        <li><a href="./recentActivities.php" class="text-white">Recent Activities</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-md-3">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled">
                        <li><strong>Name:</strong> Charity Trust</li>
                        <li><strong>Email:</strong> support@charitytrust.org</li>
                        <li><strong>Address:</strong> 123 Charity St, Cityville, Country</li>
                    </ul>
                </div>

                <!-- Discovery Apps & Social Media -->
                <div class="col-md-3">
                    <h5>Follow Us</h5>
                    <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white ml-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white ml-3"><i class="fab fa-instagram"></i></a>
                </div>

                <!-- Newsletter Subscription -->
                <div class="col-md-3">
                    <h5>Discovery Apps</h5>
                    <p>Download our app to stay connected with the latest activities and donations.</p>
                    <a href="#" class="btn btn-light btn-sm">Download Now</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS & jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php mysqli_free_result($result); ?>
