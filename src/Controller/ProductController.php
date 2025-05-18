<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Product;
use App\Model\User;

class ProductController {
    private Product $productModel;
    private User $userModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->userModel = new User();
    }

    public function getUserModel(): User {
        return $this->userModel;
    }

    public function index(): array {
        if (!$this->userModel->isLoggedIn()) {
            header('Location: /project/views/login.php');
            exit;
        }
        return $this->productModel->readAll();
    }

    public function create(array $data): bool {
        return $this->productModel->create($data);
    }

    public function edit(int $id): ?array {
        return $this->productModel->read($id);
    }

    public function update(int $id, array $data): bool {
        return $this->productModel->update($id, $data);
    }

    public function delete(int $id): bool {
        return $this->productModel->delete($id);
    }
}
?>