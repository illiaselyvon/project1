<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Controller/ProductController.php';
require_once __DIR__ . '/../src/Model/Contact.php';

use App\Model\Contact;

session_start();
$controller = new \App\Controller\ProductController();
$products = $controller->index();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_action'])) {
    $contactModel = new \App\Model\Contact();
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if ($contactModel->saveContact($name, $email, $subject, $message)) {
        $contactSuccess = "Your message has been sent successfully!";
    } else {
        $contactError = "Failed to send your message. Please try again.";
    }
}

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
<?php if (isset($_SESSION['user_id'])): ?>
    <div id="welcome-message" class="text-center text-primary fw-bold" style="font-size: 2rem; margin-top: 20px;">
        You're welcome!
    </div>
<?php endif; ?>

<div id="promo-slider" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/slider1.jpg" class="d-block w-100" alt="Promo 1">
            <div class="carousel-caption d-none d-md-block">
                <h5>Special Offer</h5>
                <p>Get 50% off on selected products!</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/slider2.jpg" class="d-block w-100" alt="Promo 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>New Arrivals</h5>
                <p>Check out our latest collection.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#promo-slider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#promo-slider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Секция продуктов -->
<div id="featured-products" class="content-section fade-section">
    <div class="container">
        <h2 class="section-title text-center mb-5">Featured Products</h2>
        <div class="row">
            <?php
            // Пример массива продуктов (замените на данные из базы данных)
            $products = [
                ['name' => 'Product 1', 'image' => 'images/product1.jpg', 'price' => 29.99],
                ['name' => 'Product 2', 'image' => 'images/product2.jpg', 'price' => 49.99],
                ['name' => 'Product 3', 'image' => 'images/product3.jpg', 'price' => 19.99],
                ['name' => 'Product 4', 'image' => 'images/product4.jpg', 'price' => 39.99],
            ];

            foreach ($products as $product): ?>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm">
                        <img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                            <p class="card-text">$<?= number_format($product['price'], 2) ?></p>
                            <a href="#" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Секция "Why Choose Us" -->
<div id="why-choose-us" class="content-section text-center">
    <div class="container">
        <h2 class="section-title mb-5">Why Choose Us</h2>
        <div class="row">
            <div class="col-md-4">
                <i class="fas fa-shipping-fast fa-3x mb-3"></i>
                <h5>Fast Shipping</h5>
                <p>We deliver your products quickly and safely.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-dollar-sign fa-3x mb-3"></i>
                <h5>Affordable Prices</h5>
                <p>Get the best deals on all our products.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-headset fa-3x mb-3"></i>
                <h5>24/7 Support</h5>
                <p>Our team is here to help you anytime.</p>
            </div>
        </div>
    </div>
</div>



<?php require_once __DIR__ . '/../footer.php'; ?>