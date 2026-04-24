<?php
class Course {

    // جلب كل المواد
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM courses");
        return $stmt->fetchAll();
    }

    // إضافة مادة
    public static function create($name, $credits, $pdo) {
        $stmt = $pdo->prepare("
            INSERT INTO courses (name, credits)
            VALUES (?, ?)
        ");
        $stmt->execute([$name, $credits]);
    }

    // جلب مادة بالـ id
    public static function find($id, $pdo) {
        $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}