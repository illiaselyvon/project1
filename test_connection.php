<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'Database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Test Connection</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Database Connection Test</h1>
        <?php
        try {
            $pdo->query("SELECT 1");
            echo "<p class='text-success'>✅ Database connection successful!<br>Database: timemanager<br>Host: 127.0.0.1</p>";
        } catch (PDOException $e) {
            error_log("Connection test error: " . $e->getMessage(), 3, 'errors.log');
            echo "<p class='text-danger'>Error testing connection: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        ?>
    </div>
</body>
</html>