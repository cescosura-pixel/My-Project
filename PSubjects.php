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
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial;
    background: #f4f6f9;
}

/* HEADER */
.header {
    background: #59c029;
    color: white;
    padding: 15px;
    text-align: center;
    position: relative;
}

/* MENU BUTTON */
.menu-btn {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 22px;
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    display: none;
}

/* LAYOUT */
.container {
    display: flex;
}

/* SIDEBAR */
.sidebar {
    width: 200px;
    background: #216103;
    height: 100vh;
    padding-top: 20px;
    transition: 0.3s;
}

.sidebar a {
    display: block;
    color: white;
    padding: 12px;
    text-decoration: none;
}

.sidebar a:hover {
    background: #1abc9c;
}

/* CONTENT */
.content {
    flex: 1;
    padding: 20px;
}

/* SUBJECT AREA */
.subject-area {
    max-width: 900px;
    margin: auto;
}

/* CARD */
.card {
    background: white;
    padding: 15px;
    margin: 10px 0;
    border-radius: 10px;
    box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
}

/* INPUTS */
input {
    padding: 10px;
    width: 100%;
    margin: 10px 0;
}

/* BUTTON */
button {
    padding: 10px 15px;
    border: none;
    background: #59c029;
    color: white;
    border-radius: 8px;
    cursor: pointer;
}

/* 📱 MOBILE */
@media (max-width: 768px) {

    .menu-btn {
        display: block;
    }

    .sidebar {
        position: fixed;
        left: -200px;
        top: 0;
        height: 100%;
        z-index: 1000;
    }

    .sidebar.active {
        left: 0;
    }

    .container {
        flex-direction: column;
    }
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <button class="menu-btn" onclick="toggleMenu()">☰</button>
    <h2>Subjects</h2>
</div>

<div class="container">

    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar">
        <a href="<?php echo $dashboard_link; ?>">Dashboard</a>
        <a href="#">Subjects</a>
        <a href="#">Assignments</a>
        <a href="#">Grades</a>
        <a href="Choose_role.php">Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <div class="subject-area">

<?php if ($role == "professor"): ?>

    <h2>Your Classes</h2>

    <form method="POST" action="CreateClass.php">
        <button type="submit">+ Create Class</button>
    </form>

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

</div>

<script>
function toggleMenu() {
    document.getElementById("sidebar").classList.toggle("active");
}
</script>

</body>
</html>