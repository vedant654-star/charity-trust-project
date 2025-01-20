<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $amount = $_POST['amount'];

    // Insert donation into database
    $sql = "INSERT INTO donations (name, amount) VALUES ('$name', '$amount')";
    if (mysqli_query($conn, $sql)) {
        header('Location: thank_you.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Donation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="my-4">
            <h1>Donate to Charity Trust</h1>
            <p>Your contribution will help us change lives.</p>
        </header>

        <form action="donation.php" method="POST">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="amount">Donation Amount ($)</label>
                <input type="number" name="amount" id="amount" class="form-control" required min="1" step="any">
            </div>

            <button type="submit" class="btn btn-primary">Donate</button>
        </form>
    </div>
</body>
</html>
