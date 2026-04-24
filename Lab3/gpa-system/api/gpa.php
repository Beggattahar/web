<?php
require '../config.php';
require '../models/GPA.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Not logged in"]);
    exit;
}

$studentId = $_SESSION['user_id'];

$gpa = GPA::calculate($studentId, $pdo);

echo json_encode([
    "gpa" => $gpa
]);