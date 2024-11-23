<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin-login.html"); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>Here you can manage your website.</p>
    
    <a href="admin-login.php" class="btn btn-danger">Logout</a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
