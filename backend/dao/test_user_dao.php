<?php
require_once(__DIR__ . '/Database.php');
require_once(__DIR__ . '/UserDAO.php');

$userDAO = new UserDAO();

$users = $userDAO->getAllUsers();
echo "<pre>";
print_r($users);
echo "</pre>";
?>

