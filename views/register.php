<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Controller/ProductController.php';

session_start();
$controller = new \App\Controller\ProductController();
if ($controller->getUserModel()->isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if ($controller->getUserModel()->register($_POST['username'], $_POST['password'])) {
            header('Location: login.php');
            exit;
        }
    } catch (\Exception $e) {
        $error = $e->getMessage(); 
    }
}
?>

<?php require_once __DIR__ . '/../header.php'; ?>


<div class="d-flex flex-column" style="min-height: 100vh;">
    <div class="content-section fade-section flex-grow-1 d-flex align-items-center justify-content-center" style="background: #f7f7f7;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card shadow-lg p-4">
                        <h3 class="mb-4 text-center text-primary">Create Your Account</h3>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" name="username" id="username" required class="form-control" placeholder="Enter your username">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" name="password" id="password" required class="form-control" placeholder="Enter your password">
                            </div>
                            <button type="submit" class="btn w-100">Register</button>
                        </form>
                        <p class="mt-3 text-center">Already have an account? <a href="login.php" class="text-decoration-none text-primary">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once __DIR__ . '/../footer.php'; ?>