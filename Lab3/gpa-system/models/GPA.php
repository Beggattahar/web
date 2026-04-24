<?php
class GPA {

    public static function calculate($studentId, $pdo) {

        $stmt = $pdo->prepare("
            SELECT g.grade, c.credits
            FROM grades g
            JOIN courses c ON g.course_id = c.id
            WHERE g.student_id = ?
        ");
        $stmt->execute([$studentId]);
        $rows = $stmt->fetchAll();

        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($rows as $row) {
            $totalPoints += $row['grade'] * $row['credits'];
            $totalCredits += $row['credits'];
        }

        if ($totalCredits == 0) return 0;

        return round($totalPoints / $totalCredits, 2);
    }
}