<?php
require_once __DIR__ . '/../dao/RegistrationDAO.php';

class RegistrationService {
    private $registrationDAO;

    public function __construct() {
        $this->registrationDAO = new RegistrationDAO();
    }

    public function getAllRegistrations() {
        return $this->registrationDAO->getAllRegistrations();
    }

    public function registerUser($registration) {
        if (!isset($registration['user_id']) || !isset($registration['event_id'])) {
            throw new Exception("Both user_id and event_id are required.");
        }
        return $this->registrationDAO->registerUser($registration);
    }
}
