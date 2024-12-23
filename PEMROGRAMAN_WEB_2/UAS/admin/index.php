<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Login - Rental PS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="width: 25rem;">
            <h4 class="mb-3 text-center">Pilih Login</h4>
            <form method="GET" action="login.php">
                <button type="submit" name="role" value="admin" class="btn btn-primary w-100 mb-3">Login sebagai Admin</button>
                <button type="submit" name="role" value="pimpinan" class="btn btn-secondary w-100">Login sebagai Pimpinan</button>
            </form>
        </div>
    </div>
</body>
</html>
    