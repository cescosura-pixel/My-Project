<?php
session_start();
require_once __DIR__ . "/authentic.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $user = authenticate($email, $password);

    if ($user) {
      
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['Email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];
        
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
  * {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f0fdf4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Container */
.box {
    width: 90%;
    max-width: 400px;
    background: white;
    padding: 25px;
    border-radius: 12px;
    border-top: 5px solid #16a34a;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    text-align: center;
}

/* Title */
h2 {
    color: #16a34a;
}

/* Inputs */
input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 16px;
}

/* Button */
.btn {
    width: 100%;
    padding: 12px;
    background: #16a34a;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
}

.btn:hover {
    background: #15803d;
}

/* Error */
.error {
    color: red;
    font-size: 14px;
}

/* Link */
a {
    display: block;
    margin-top: 10px;
    color: #16a34a;
    text-decoration: none;
}

/* Password Container */
.password-container {
    position: relative;
    width: 100%;
}

/* Eye icon */
.toggle-btn {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
}

/* 📱 MOBILE (small phones) */
@media (max-width: 480px) {
    .box {
        padding: 20px;
    }

    h2 {
        font-size: 20px;
    }
}

/* 📲 TABLET */
@media (min-width: 481px) and (max-width: 768px) {
    .box {
        max-width: 500px;
    }
}

/* 💻 DESKTOP */
@media (min-width: 769px) {
    .box {
        max-width: 400px;
    }
}
    </style>
</head>

<body>

<div class="box">

    <h2>Login</h2>
<form method="POST">

    <input type="email" name="email" placeholder="Email" required>

    <div class="password-container">
        <input type="password" name="password" id="password" placeholder="Password" required>
        <button type="button" class="toggle-btn" onclick="togglePassword()">👁</button>
    </div>

    <button class="btn" type="submit">Login</button>

</form>

    <p class="error"><?php echo $error; ?></p>

    <a href="register.php">Create Account</a>

</div>
<script>
 function togglePassword() {
   const pass = document.getElementById('password');
   pass.type = (pass.type === 'password') ? 'text' : 'password';
}

</script>

</body>
</html>