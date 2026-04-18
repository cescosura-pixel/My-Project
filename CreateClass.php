<?php
session_start();
include "connection.php";

// =========================
// SESSION CHECK
// =========================
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'professor') {
    die("Access denied.");
}

// =========================
// CREATE CLASS
// =========================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['class_name'])) {
        $error = "Class name is required.";
    } else {

        $professor_id = $_SESSION['id'];
        $class_name = $_POST['class_name'];

        // generate class code
        $class_code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);

        $sql = "INSERT INTO classes (class_name, class_code, professor_id)
                VALUES ('$class_name', '$class_code', '$professor_id')";

        if (mysqli_query($conn, $sql)) {
            $success = "Class created! Code: " . $class_code;
        } else {
            $error = "Database error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Class</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body {
    font-family: Arial;
    background: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.container {
    width: 100%;
    max-width: 420px;
    margin: 60px auto;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    font-size: 22px;
}

input {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    font-size: 16px;
    box-sizing: border-box;
}

button {
    width: 100%;
    padding: 12px;
    margin-top: 15px;
    background: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
}

.message {
    margin-top: 15px;
    text-align: center;
    color: green;
}

.error {
    color: red;
    text-align: center;
}

/* Tablet */
@media (max-width: 768px) {
    .container {
        margin: 40px auto;
        padding: 20px;
    }
}

/* Mobile */
@media (max-width: 480px) {
    .container {
        margin: 20px auto;
        padding: 15px;
    }

    h2 {
        font-size: 20px;
    }
}
</style>
</head>

<body>

<div class="container">
    <h2>Create Class</h2>

    <form method="POST">
        <label>Class Name</label>
        <input type="text" name="class_name" required>

        <button type="submit">Create Class</button>
    </form>

    <?php if (isset($success)) { ?>
        <div class="message"><?php echo $success; ?></div>
    <?php } ?>

    <?php if (isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
</div>

</body>
</html>