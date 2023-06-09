<?php
$hostname = 'localhost';
$username = 'trendi10_kev';
$password = 'kev@noones2023';
$database = 'trendi10_kev';

// Create a connection
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate login credentials
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch data from the admins table
    $query = "SELECT username, password FROM admins";
    $result = mysqli_query($conn, $query);

    $isValid = false;

    while ($row = mysqli_fetch_assoc($result)) {
        if ($username === $row['username'] && $password === $row['password']) {
            $isValid = true;
            break;
        }
    }

    if ($isValid) {
        // Redirect to the dashboard if credentials are valid
        header("Location: dashboard.php");
        exit();
    } else {
        // Display an error message if credentials are invalid
        $errorMessage = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <script src="login.js"></script>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <?php if (isset($errorMessage)) { ?>
                <p class="error"><?php echo $errorMessage; ?></p>
            <?php } ?>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>

<?php
// Close the connection
mysqli_close($conn);
?>
