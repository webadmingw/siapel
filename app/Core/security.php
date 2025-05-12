<?php
class Security {
    // Sanitize input untuk mencegah XSS
    public static function sanitizeInput($data) {
        if (is_array($data)) {
            foreach($data as $key => $value) {
                $data[$key] = self::sanitizeInput($value);
            }
            return $data;
        }
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }

    // Sanitize output untuk news content
    public static function sanitizeOutput($content) {
        // Hapus semua tag script
        $content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $content);
        
        // Whitelist tag HTML yang diperbolehkan
        $allowed_tags = '<p><br><strong><em><ul><li><ol><h1><h2><h3><h4><h5><h6><blockquote>';
        return strip_tags($content, $allowed_tags);
    }

    // Fungsi untuk password hashing
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_ARGON2ID, [
            'memory_cost' => 65536,
            'time_cost' => 4,
            'threads' => 3
        ]);
    }

    // Fungsi untuk verifikasi password
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    // Fungsi untuk mencegah CSRF
    public static function generateCSRFToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function verifyCSRFToken($token) {
        if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
            throw new Exception('CSRF token validation failed');
        }
        return true;
    }
}
