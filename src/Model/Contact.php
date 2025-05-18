<?php

declare(strict_types=1);

namespace App\Model;

use App\Config\Database;
use PDO;

class Contact {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function saveContact(string $name, string $email, string $subject, string $message): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO contacts (name, email, subject, message) VALUES (:name, :email, :subject, :message)"
        );
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);
    }
}
?>