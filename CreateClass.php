<?php
session_start();
include "Connection.php";

if (!isset($_SESSION['id'])) {
    header("Location: Login.php");
    exit();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'professor') {
    die("Access denied.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['class_name'])) {

    $professor_id = $_SESSION['id'];
    $class_name = $_POST['class_name'];

    $class_code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);

    $sql = "INSERT INTO classes (class_name, class_code, professor_id)
            VALUES ('$class_name', '$class_code', '$professor_id')";

    if (mysqli_query($conn, $sql)) {
        header("Location: Subjects.php"); // ✅ redirect after success
        exit();
    } else {
        $error = "Database error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Class</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body { font-family:Arial; background:#f4f4f4; }
.container {
    max-width:400px;
    margin:60px auto;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
input {
    width:100%;
    padding:12px;
    margin-top:10px;
}
button {
    width:100%;
    padding:12px;
    margin-top:15px;
    background:#4CAF50;
    color:white;
    border:none;
}
.error {
    color:red;
    text-align:center;
    margin-top:10px;
}
</style>
</head>

<body>

<div class="container">
    <h2>Create Class</h2>

    <form method="POST">
        <input type="text" name="class_name" placeholder="Enter class name" required>
        <button type="submit">Create Class</button>
    </form>

    <?php if (isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
</div>

</body>
</html>