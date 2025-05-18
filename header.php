<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animate.css">
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">
<nav class="navbar navbar-expand-lg" style="background: #2d3748; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); position: fixed; top: 0; width: 100%; z-index: 1000;">
    <div class="container">
        <a class="navbar-brand" href="#" style="color: white !important; font-weight: 600;">Product Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="color: white;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/project/views/index.php" style="color: white;">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/project/views/contact.php" style="color: white;">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="/project/views/product_management.php" style="color: white;">Product Management</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="/project/views/logout.php" style="color: white;">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/project/views/login.php" style="color: white;">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
    <li class="nav-item">
    <div class="form-check form-switch text-white">
        <input class="form-check-input" type="checkbox" id="darkModeSwitch">
        <label class="form-check-label" for="darkModeSwitch">Dark Mode</label>
    </div>
</li>
    <style>
        .nav-link:hover, .nav-link.active { color: #ed64a6 !important; transition: color 0.3s ease; }
    </style>