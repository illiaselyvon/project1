<?php
namespace App\Model;

use PDO;

class User
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = \App\Config\Database::getInstance();
    }
    public function register(string $username, string $password): bool
{
    
    $stmt = $this->pdo->prepare("SELECT id FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    if ($stmt->fetch()) {
        return false; 
    }

       $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    return $stmt->execute([
        'username' => $username,
        'password' => $hashedPassword
    ]);
}

    public function login(string $username, string $password): bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
        return false;
    }
    public function logout(): void
{
    session_unset();
    session_destroy();
}
    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }
}