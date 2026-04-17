<?php
require_once __DIR__ . "/Connection.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if ($stmt->execute()) {
        $message = "Account created successfully!";
    } else {
        $message = "Error: Email may already exist.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <style>
        body {
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
            text-align: center;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #16a34a;
            color: white;
            border: none;
        }

        a {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>Register</h2>

    <form method="POST">

        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <select name="role">
            <option value="student">Student</option>
            <option value="professor">Professor</option>
        </select>

        <button class="btn" type="submit">Register</button>

    </form>

    <p><?php echo $message; ?></p>

    <a href="Login.php">Back to Login</a>

</div>

</body>
</html>