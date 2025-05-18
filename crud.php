<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'Database.php';

if (!$pdo) {
    error_log("PDO object not initialized", 3, 'errors.log');
    die("Error: PDO object not initialized.");
}

// Initialize $editProduct
$editProduct = null;

// Handle deletion
if (isset($_GET['delete'])) {
    try {
        $id = (int)$_GET['delete'];
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: index.php#products");
        exit;
    } catch (PDOException $e) {
        error_log("Delete error: " . $e->getMessage(), 3, 'errors.log');
        die("Error deleting product: " . $e->getMessage());
    }
}

// Handle editing
if (isset($_GET['edit'])) {
    try {
        $id = (int)$_GET['edit'];
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $editProduct = $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Edit fetch error: " . $e->getMessage(), 3, 'errors.log');
        die("Error fetching product: " . $e->getMessage());
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = trim($_POST['name'] ?? '');
        $price = floatval($_POST['price'] ?? 0.00);
        $stock = (int)($_POST['stock'] ?? 0);
        $category = trim($_POST['category'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (empty($name) || $price < 0 || $stock < 0) {
            throw new Exception("Please fill all required fields with valid values.");
        }

        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Update
            $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, stock = ?, category = ?, description = ? WHERE id = ?");
            $stmt->execute([$name, $price, $stock, $category, $description, (int)$_POST['id']]);
        } else {
            // Create
            $stmt = $pdo->prepare("INSERT INTO products (name, price, stock, category, description) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $price, $stock, $category, $description]);
        }

        header("Location: index.php#products");
        exit;
    } catch (Exception $e) {
        error_log("Form submission error: " . $e->getMessage(), 3, 'errors.log');
        die("Error saving product: " . $e->getMessage());
    }
}

// Fetch product list
try {
    $products = $pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();
} catch (PDOException $e) {
    error_log("Fetch products error: " . $e->getMessage(), 3, 'errors.log');
    $products = [];
}
?>