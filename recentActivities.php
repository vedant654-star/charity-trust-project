<?php
include('db.php');

// Fetch recent activities from the database
$sql = "SELECT * FROM activities ORDER BY date DESC LIMIT 5";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Activities - Charity Trust</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .activity-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .activity-card img {
            border-radius: 10px 10px 0 0;
        }

        .activity-card-body {
            padding: 20px;
        }

        .activity-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .activity-description {
            margin-bottom: 15px;
        }

        .activity-date {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <header class="bg-dark text-white py-4">
        <div class="container">
            <h1 class="display-4">Recent Activities</h1>
            <p class="lead">Stay updated with our latest charity activities and projects.</p>
        </div>
    </header>

    <!-- Recent Activities Section -->
    <section class="container">
        <h2 class="mb-4">Latest Charity Activities</h2>
        <div class="row">
            <?php
            // Check if any activities are found
            if (mysqli_num_rows($result) > 0) {
                // Loop through the activities and display them
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-md-4">
                        <div class="card activity-card">
                            <img class="card-img-top" src="data:image/jpeg;base64,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" alt="Activity Image">
                            <div class="card-body activity-card-body">
                                <h5 class="activity-title"><?php echo $row['title']; ?></h5>
                                <p class="activity-description"><?php echo substr($row['description'], 0, 150) . '...'; ?></p>
                                <p class="activity-date"><?php echo date('F j, Y', strtotime($row['date'])); ?></p>
                                <a href="activityDetail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No recent activities found.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <p class="text-center">&copy; 2025 Charity Trust. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS & jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Free result set and close connection
mysqli_free_result($result);
mysqli_close($conn);
?>
