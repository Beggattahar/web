<?php
require 'models/GPA.php';

class StudentController {

    public static function dashboard($pdo) {

        $studentId = $_SESSION['user_id'];

        $gpa = GPA ::calculate($studentId, $pdo);

        include 'views/student/dashboard.php';
    }
}
