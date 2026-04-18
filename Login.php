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
            width: 350px;
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
            width: 350px;
            padding: 10px;
            background: #16a34a;
            color: white;
            border: none;
            border-radius: 15px;
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
        .password-container {
            position: relative;
            width: 100%;
            max-width: 300px;
        }
        .password-container input {
    width: 100%;
    padding: 10px 40px 10px 10px; 
    font-size: 16px;
}
.toggle-btn {
    position: absolute;
    left: 320px;
    top: 55%; 
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
}
    </style>
</head>

<body>

<div class="box">

    <h2>Login</h2>

    <form method="POST">
        <div class="password-container">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <button type="button" class="toggle-btn" onclick="togglePassword()">👁</button>
        <button class="btn" type="submit">Login</button>
        </div>
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