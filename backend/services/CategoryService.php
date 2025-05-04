<?php
require_once __DIR__ . '/../dao/CategoryDAO.php';

class CategoryService {
    private $categoryDAO;

    public function __construct() {
        $this->categoryDAO = new CategoryDAO();
    }

    public function getAllCategories() {
        return $this->categoryDAO->getAllCategories();
    }

    public function addCategory($category) {
        if (!isset($category['name'])) {
            throw new Exception("Category name is required.");
        }
        return $this->categoryDAO->addCategory($category);
    }
}
