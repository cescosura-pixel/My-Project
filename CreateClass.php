<?php
session_start();
include "connection.php";


if (!isset($_SESSION['id'])) {
    die("You must be logged in.");
}

// check role (only professor allowed)
if ($_SESSION['role'] !== 'professor') {
    die("Access denied.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['class_name']) || empty($_POST['class_name'])) {
        $error = "Class name is required.";
    } else {

        $professor_id = $_SESSION['id'];
        $class_name = $_POST['class_name'];

        // generate class code
        $class_code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);

        // insert query
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
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }
        .container {
            width: 350px;
            margin: 100px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .message {
            margin-top: 15px;
            text-align: center;
            color: green;
        }
        .error {
            color: red;
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

    <?php if(isset($success)) { ?>
        <div class="message"><?php echo $success; ?></div>
    <?php } ?>

    <?php if(isset($error)) { ?>
        <div class="message error"><?php echo $error; ?></div>
    <?php } ?>
</div>

</body>
</html>