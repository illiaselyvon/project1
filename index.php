<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Controller/ProductController.php';

session_start();
$controller = new \App\Controller\ProductController();
$products = $controller->index();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add' && $controller->create($_POST)) {
        header('Location: index.php#products');
        exit;
    } elseif ($_POST['action'] === 'update' && isset($_POST['id']) && $controller->update((int)$_POST['id'], $_POST)) {
        header('Location: index.php#products');
        exit;
    }
}

if (isset($_GET['delete']) && is_numeric($_GET['delete']) && $controller->delete((int)$_GET['delete'])) {
    header('Location: index.php#products');
    exit;
}

$editProduct = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $editProduct = $controller->edit((int)$_GET['edit']);
}
?>

<?php require_once __DIR__ . '/../header.php'; ?>

<div id="services" class="content-section fade-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card p-4 text-center h-100">
                    <span class="service-icon first mb-3 d-inline-block"></span>
                    <h3 class="mt-3">Responsive Layout</h3>
                    <p>Template based on HTML5 and Bootstrap. Perfect for any device.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card p-4 text-center h-100">
                    <span class="service-icon second mb-3 d-inline-block"></span>
                    <h3 class="mt-3">Mobile Support</h3>
                    <p>Visit <a href="https://www.toocss.com" target="_blank" rel="nofollow" class="text-pink-600 hover:underline">Too CSS blog</a> for new templates.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card p-4 text-center h-100">
                    <span class="service-icon third mb-3 d-inline-block"></span>
                    <h3 class="mt-3">High Standards</h3>
                    <p>Our solutions meet the highest quality standards.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card p-4 text-center h-100">
                    <span class="service-icon fourth mb-3 d-inline-block"></span>
                    <h3 class="mt-3">Quick Support</h3>
                    <p>We are always ready to assist you at any time.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="product-promotion" class="content-section bg-white fade-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="section-title">New Arrivals</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-sm-3 mb-3">
                <div class="card text-center">
                    <img src="public/images/promotion/promotion1.jpg" class="promo-img" alt="Product 1">
                    <div class="card-body">
                        <h4 class="card-title">Nullam Non Ultrices</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-6 mb-3">
                <div class="card">
                    <img src="public/images/promotion/promotion2.jpg" class="promo-img" alt="Product 2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="card-title">Fusce facilisis magna</h2>
                            <span class="text-warning">Rating: ★★★★½</span>
                        </div>
                        <p class="card-text">Maecenas erat lacus, ultrices vel orci ac, eleifend pulvinar est. Proin mollis purus...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-3 mb-3">
                <div class="card text-center">
                    <img src="public/images/promotion/promotion3.jpg" class="promo-img" alt="Product 3">
                    <div class="card-body">
                        <h4 class="card-title">Morbi Sit Amet</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="products" class="content-section fade-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="section-title">Product Management</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card p-4">
                    <h3 class="mb-4"><?= $editProduct ? "Edit Product" : "Add Product" ?></h3>
                    <form method="POST" class="task-form">
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
                        <button type="submit" class="button"><?= $editProduct ? "Save Changes" : "Add Product" ?></button>
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
                                                <a href="?edit=<?= htmlspecialchars($product['id']) ?>" class="action-link edit"><i class="fas fa-edit"></i> Edit</a>
                                                <a href="?delete=<?= htmlspecialchars($product['id']) ?>" class="action-link delete" onclick="return confirm('Delete this product?')"><i class="fas fa-trash-alt"></i> Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="7" class="text-center">No products available.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="contact" class="content-section bg-white fade-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="section-title">Contact</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center mb-4">
                <p class="lead">Get in touch with us! We're ready to answer any of your questions.</p>
            </div>
            <div class="col-md-6">
                <div id="map"></div>
            </div>
            <div class="col-md-6">
                <div class="card p-4">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" placeholder="Message" rows="4" required></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="button">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../footer.php'; ?>