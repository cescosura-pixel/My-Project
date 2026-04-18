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
    max-width: 420px;
    background: white;
    padding: 25px;
    border-radius: 12px;
    border-top: 5px solid #16a34a;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* Title */
h2 {
    color: #16a34a;
}

/* Inputs */
input, select {
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

/* Link */
.login-back {
    display: block;
    margin-top: 10px;
    text-decoration: none;
    color: #16a34a;
}

/* Password container */
.password-container {
    position: relative;
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
}

/* Responsive */
@media (max-width: 480px) {
    .box {
        padding: 20px;
    }
}
</style>
</head>

<body>

<div class="box">

    <h2>Register</h2>

    <form method="POST" onsubmit="return validatePasswords()">

        <input type="text" name="name" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email" required>

        <div class="password-container">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <button type="button" class="toggle-btn" onclick="togglePassword()">👁</button>
        </div>

        <input type="password" id="confirmPassword" placeholder="Confirm Password" required>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="student">Student</option>
            <option value="professor">Professor</option>
        </select>

        <button class="btn" type="submit">Register</button>

    </form>

    <p><?php echo $message; ?></p>

    <a class="login-back" href="Login.php">Back to Login</a>

</div>
<script>
function togglePassword() {
    const pass = document.getElementById('password');
    pass.type = (pass.type === 'password') ? 'text' : 'password';
}

function validatePasswords() {
    const pass = document.getElementById('password').value;
    const confirm = document.getElementById('confirmPassword').value;

    if (pass !== confirm) {
        alert("Passwords do not match!");
        return false;
    }
    return true;
}
</script>

</body>
</html>