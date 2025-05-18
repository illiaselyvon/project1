<?php
declare(strict_types=1);

namespace App\Model;

use App\Config\Database;
use PDO;

class Product {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): bool {
    $stmt = $this->db->prepare(
        "INSERT INTO products (name, price, stock, category, description, image) VALUES (:name, :price, :stock, :category, :description, :image)"
    );
    return $stmt->execute([
        ':name' => $data['name'],
        ':price' => floatval($data['price']),
        ':stock' => (int)$data['stock'],
        ':category' => $data['category'] ?? null,
        ':description' => $data['description'] ?? null,
        ':image' => $data['image'] ?? null
    ]);
    }

    public function readAll(): array {
        $stmt = $this->db->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll() ?: [];
    }

    public function read(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

   public function update(int $id, array $data): bool {
    $stmt = $this->db->prepare(
        "UPDATE products SET name = :name, price = :price, stock = :stock, category = :category, description = :description, image = :image WHERE id = :id"
    );
    return $stmt->execute([
        ':id' => $id,
        ':name' => $data['name'],
        ':price' => floatval($data['price']),
        ':stock' => (int)$data['stock'],
        ':category' => $data['category'] ?? null,
        ':description' => $data['description'] ?? null,
        ':image' => $data['image'] ?? null
    ]);
}

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}