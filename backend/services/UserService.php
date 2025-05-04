<?php
require_once __DIR__ . '/../dao/UserDAO.php';

class UserService {
    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO();
    }

    public static function getAll() {
        echo 'Lista korisnika';
    }
        
    public function getAllUsers() {
        return $this->userDAO->getAllUsers();
    }

    public function getUserById($id) {
        return $this->userDAO->getUserById($id);
    }

    public function addUser($user) {
        if (!isset($user['email']) || !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Valid email is required.");
        }
        return $this->userDAO->addUser($user);
    }

    public function updateUser($id, $user) {
        return $this->userDAO->updateUser($id, $user);
    }

    public function deleteUser($id) {
        return $this->userDAO->deleteUser($id);
    }
}
