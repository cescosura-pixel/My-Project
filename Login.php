<?php
session_start();
require_once __DIR__ . "/authentic.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $user = authenticate($email, $password);

    if ($user) {

        $_SESSION['email'] = $user['Email'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === "student") {
            header("Location: dashboard_student.php");
        } elseif ($user['role'] === "professor") {
            header("Location: dashboard_prof.php");
        }

        exit();

    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f0fdf4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            width: 340px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            border-top: 5px solid #16a34a;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            color: #16a34a;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #16a34a;
            color: white;
            border: none;
            border-radius: 8px;
        }

        .btn:hover {
            background: #15803d;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        a {
            display: block;
            margin-top: 10px;
            color: #16a34a;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>Login</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button class="btn" type="submit">Login</button>
    </form>

    <p class="error"><?php echo $error; ?></p>

    <a href="register.php">Create Account</a>

</div>

</body>
</html>