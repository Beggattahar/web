<?php
class User {

    // جلب مستخدم عبر email (لـ login)
    public static function findByEmail($email, $pdo) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // إنشاء مستخدم جديد
    public static function create($name, $email, $password, $role, $pdo) {
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("
            INSERT INTO users (name, email, password, role)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$name, $email, $hash, $role]);
    }

    // جلب مستخدم بالـ id
    public static function findById($id, $pdo) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}