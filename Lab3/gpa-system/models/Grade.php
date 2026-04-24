<?php
class Grade {

    public static function add($studentId, $courseId, $grade, $pdo) {

        $stmt = $pdo->prepare("
            INSERT INTO grades (student_id, course_id, grade)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$studentId, $courseId, $grade]);
    }
}