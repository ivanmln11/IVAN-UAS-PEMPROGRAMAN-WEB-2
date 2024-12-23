<?php
session_start();
include 'koneksi.php';

$role = isset($_GET['role']) ? $_GET['role'] : '';

// Check if role is passed; if not, redirect to the role selection page
if (!$role) {
    header('Location: login_choice.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to find the user based on username and role
    $query = "SELECT * FROM tb_user WHERE username = '$username' AND level = '$role'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password using password_verify
        if (password_verify($password, $user['password'])) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['level'] = $user['level'];
            $_SESSION['username'] = $user['username'];

            // Redirect based on the user level
            if ($user['level'] == 'Admin') {
                $_SESSION['admin_logged_in'] = true;
                header('Location: admin_dashboard.php');
            } elseif ($user['level'] == 'Pimpinan') {
                $_SESSION['pimpinan_logged_in'] = true;
                header('Location: pimpinan_dashboard.php');
            }
            exit;
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Username not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rental PS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="width: 25rem;">
            <h4 class="mb-3 text-center">Login as <?= ucfirst($role) ?></h4>
            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
