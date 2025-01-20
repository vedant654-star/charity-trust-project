<?php 

session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header('Location: login.php');
    exit();
}

// Fetch all donations from the database
$sql = "SELECT * FROM donations";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Donations</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
        <h2>Manage Donations</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Donor Name</th>
                    <th>Amount</th>
                    <th>Donation Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo date('F j, Y', strtotime($row['date'])); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Free result set and close connection
mysqli_free_result($result);
mysqli_close($conn);
?>