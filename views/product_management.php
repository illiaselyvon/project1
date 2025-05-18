<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Controller/ProductController.php';

session_start();
$controller = new \App\Controller\ProductController();

if (!$controller->getUserModel()->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$products = $controller->index();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'add' && $controller->create($_POST)) {
        header('Location: product_management.php');
        exit;
    } elseif ($_POST['action'] === 'update' && isset($_POST['id']) && $controller->update((int)$_POST['id'], $_POST)) {
        header('Location: product_management.php');
        exit;
    }
}

if (isset($_GET['delete']) && is_numeric($_GET['delete']) && $controller->delete((int)$_GET['delete'])) {
    header('Location: product_management.php');
    exit;
}

$editProduct = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $editProduct = $controller->edit((int)$_GET['edit']);
}
?>

<?php require_once __DIR__ . '/../header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Product Management</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card p-4">
                <h3 class="mb-4"><?= $editProduct ? "Edit Product" : "Add Product" ?></h3>
                <form method="POST">
                    <input type="hidden" name="id" value="<?= isset($editProduct['id']) ? htmlspecialchars($editProduct['id']) : '' ?>">
                    <input type="hidden" name="action" value="<?= $editProduct ? "update" : "add" ?>">
                    <div class="form-group mb-3">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" required class="form-control" value="<?= isset($editProduct['name']) ? htmlspecialchars($editProduct['name']) : '' ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Price ($):</label>
                        <input type="number" name="price" id="price" step="0.01" required class="form-control" value="<?= isset($editProduct['price']) ? htmlspecialchars($editProduct['price']) : '' ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="stock">Stock:</label>
                        <input type="number" name="stock" id="stock" min="0" required class="form-control" value="<?= isset($editProduct['stock']) ? htmlspecialchars($editProduct['stock']) : '' ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="category">Category:</label>
                        <input type="text" name="category" id="category" class="form-control" value="<?= isset($editProduct['category']) ? htmlspecialchars($editProduct['category']) : '' ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control"><?= isset($editProduct['description']) ? htmlspecialchars($editProduct['description']) : '' ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><?= $editProduct ? "Save Changes" : "Add Product" ?></button>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-4">
                <h3 class="mb-4">Product List</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($products)): ?>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($product['id']) ?></td>
                                        <td><?= htmlspecialchars($product['name']) ?></td>
                                        <td>$<?= number_format($product['price'], 2) ?></td>
                                        <td><?= htmlspecialchars($product['stock']) ?></td>
                                        <td><?= htmlspecialchars($product['category']) ?></td>
                                        <td><?= htmlspecialchars($product['description']) ?></td>
                                        <td>
                                            <a href="?edit=<?= htmlspecialchars($product['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="?delete=<?= htmlspecialchars($product['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No products available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../footer.php'; ?>