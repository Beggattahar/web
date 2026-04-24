<?php
require '../config.php';
require '../models/Grade.php';

if ($_POST['action'] == 'add') {

    Grade::add(
        $_POST['student_id'],
        $_POST['course_id'],
        $_POST['grade'],
        $pdo
    );

    echo json_encode([
        "success" => true
    ]);
}