<?php
namespace App\Controller;

use App\Model\User;

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function register(string $username, string $password): bool
    {
        return $this->model->register($username, $password);
    }

    public function isLoggedIn(): bool
    {
        return $this->model->isLoggedIn();
    }
}