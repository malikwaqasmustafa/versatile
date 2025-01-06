<?php

/**
 * Base URL helper.
 * Get the full URL path for assets or links.
 */
function base_url($path = '') {
    $base = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
    return $base . '/' . ltrim($path, '/');
}

/**
 * Redirect helper.
 * Redirect to another page.
 */
function redirect($url) {
    header("Location: $url");
    exit;
}

/**
 * Escape HTML special characters.
 * Prevent XSS attacks.
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Check if request is POST.
 */
function is_post() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Get input safely from $_POST or $_GET.
 */
function input($key, $default = null) {
    if (isset($_POST[$key])) {
        return trim($_POST[$key]);
    } elseif (isset($_GET[$key])) {
        return trim($_GET[$key]);
    }
    return $default;
}

/**
 * Generate a CSRF token for forms.
 * Requires session_start() in your app.
 */
function csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate a CSRF token.
 */
function validate_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Flash messages helper.
 * Set or get flash messages stored in session.
 */
function flash($key, $message = null) {
    if ($message === null) {
        // Retrieve and clear the flash message
        $msg = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $msg;
    }
    // Set a flash message
    $_SESSION['flash'][$key] = $message;
}

/**
 * Generate a random string.
 */
function random_string($length = 16) {
    return bin2hex(random_bytes($length / 2));
}

/**
 * Load a view with data.
 */
function view($view, $data = []) {
    extract($data);
    require "../app/views/$view.php";
}

/**
 * Debugging helper.
 * Dump variables and stop execution.
 */
function dd(...$vars) {
    echo '<pre>';
    foreach ($vars as $var) {
        print_r($var);
    }
    echo '</pre>';
    exit;
}
