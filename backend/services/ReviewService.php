<?php
require_once __DIR__ . '/../dao/ReviewDAO.php';

class ReviewService {
    private $reviewDAO;

    public function __construct() {
        $this->reviewDAO = new ReviewDAO();
    }

    public function getAllReviews() {
        return $this->reviewDAO->getAllReviews();
    }

    public function addReview($review) {
        if (!isset($review['content'])) {
            throw new Exception("Review content is required.");
        }
        return $this->reviewDAO->addReview($review);
    }
}