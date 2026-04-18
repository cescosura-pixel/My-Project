<?php
session_start();
include "Connection.php";

if (!isset($_SESSION['role'])) {
    header("Location: Login.php");
    exit();
}

$role = $_SESSION['role'];
$user_id = $_SESSION['id'];

/* Dynamic dashboard link */
$dashboard_link = ($role === "professor") ? "dashboard_prof.php" : "dashboard_student.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Subjects</title>

<style>
body { margin:0; font-family:Arial; background:#f4f6f9; }
.header { background:#59c029; color:white; padding:15px; text-align:center; }
.container { display:flex; }
.sidebar { width:200px; background:#216103; height:100vh; padding-top:20px; }
.sidebar a { display:block; color:white; padding:12px; text-decoration:none; }
.sidebar a:hover { background:#1abc9c; }
.content { flex:1; padding:20px; }
.card { background:white; padding:15px; margin:10px 0; border-radius:10px; box-shadow:2px 2px 5px rgba(0,0,0,0.1); }
button { padding:10px 15px; border:none; background:#59c029; color:white; border-radius:8px; cursor:pointer; }
</style>
</head>

<body>

<div class="header">
    <h2>Subjects</h2>
</div>

<div class="container">

    <div class="sidebar">
        <a href="<?php echo $dashboard_link; ?>">Dashboard</a>
        <a href="#">Subjects</a>
        <a href="#">Assignments</a>
        <a href="#">Grades</a>
        <a href="Choose_role.php">Logout</a>
    </div>

    <div class="content">

<?php if ($role == "professor"): ?>

    <h2>Your Classes</h2>

    
    <a href="CreateClass.php">
        <button type="button">+ Create Class</button>
    </a>

    <?php
    $query = "SELECT * FROM classes WHERE professor_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card'>";
        echo "<h3>" . $row['class_name'] . "</h3>";
        echo "<p>Code: " . $row['class_code'] . "</p>";
        echo "</div>";
    }
    ?>

<?php elseif ($role == "student"): ?>

    <h2>My Subjects</h2>

    <form method="POST" action="join_class.php">
        <input type="text" name="class_code" placeholder="Enter class code" required>
        <button type="submit">Join Class</button>
    </form>

    <hr>

    <?php
    $query = "SELECT classes.* FROM classes
              JOIN enrollments ON classes.class_id = enrollments.class_id
              WHERE enrollments.student_id = '$user_id'";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card'>";
        echo "<h3>" . $row['class_name'] . "</h3>";
        echo "</div>";
    }
    ?>

<?php endif; ?>

    </div>
</div>

</body>
</html>