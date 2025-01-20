<?php
include('db.php');
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Fetch all activities from the database
$sql = "SELECT * FROM activities";
$result = mysqli_query($conn, $sql);

// Handle Add, Edit, Delete requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_activity'])) {
        // Add new activity
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];

        $sql_add = "INSERT INTO activities (title, description, date) VALUES ('$title', '$description', '$date')";
        mysqli_query($conn, $sql_add);
    } elseif (isset($_POST['delete_activity'])) {
        // Delete activity
        $activity_id = $_POST['activity_id'];
        $sql_delete = "DELETE FROM activities WHERE id = $activity_id";
        mysqli_query($conn, $sql_delete);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Activities - Charity Trust</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Manage Recent Activities</h2>

        <!-- Form to Add New Activity -->
        <form method="POST" action="manageActivities.php">
            <div class="form-group">
                <label for="title">Activity Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Activity Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="date">Activity Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <button type="submit" name="add_activity" class="btn btn-primary">Add Activity</button>
        </form>

        <h3 class="mt-5">Existing Activities</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo date('F j, Y', strtotime($row['date'])); ?></td>
                        <td>
                            <!-- Delete Activity -->
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="activity_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_activity" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

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
