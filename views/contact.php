<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Model/Contact.php';

use App\Model\Contact;

session_start();

$contactModel = new Contact();
$contactSuccess = null;
$contactError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
?>

<?php require_once __DIR__ . '/../header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Contact Us</h1>
    <div class="row">
        <div class="col-md-6">
            <div id="map" style="height: 400px; border: 1px solid #ddd;"></div>
            <script>
                function initMap() {
                    const location = { lat: 55.7558, lng: 37.6173 };
                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 15,
                        center: location,
                    });
                    new google.maps.Marker({
                        position: location,
                        map: map,
                        title: "We are here!",
                    });
                }
            </script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
        </div>
        <div class="col-md-6">
            <?php if ($contactSuccess): ?>
                <div class="alert alert-success"><?= htmlspecialchars($contactSuccess) ?></div>
            <?php elseif ($contactError): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($contactError) ?></div>
            <?php endif; ?>
            <form method="POST" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-12">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                </div>
                <div class="col-12">
                    <textarea name="message" class="form-control" placeholder="Message" rows="4" required></textarea>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../footer.php'; ?>