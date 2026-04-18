<?php
require_once __DIR__ . "/Connection.php";

function authenticate($email, $password) {

    global $conn;

    $sql = "SELECT Email, Password, role, name FROM users WHERE Email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['Password'])) {
            return $user;
        }
    }

    return false;
}
?>