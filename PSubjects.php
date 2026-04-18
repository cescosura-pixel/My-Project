<?php
session_start();
include "Connection.php";

$role = $_SESSION['role'];
$user_id = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>
    <style>
        body {
    margin:0;
    font-family: Arial;
    background:#f4f6f9;
}
   .header {
    background: #59c029;
    color:white;
    padding:15px;
    text-align:center;
}
.container {
    display:flex;
}
.sidebar {
    width:200px;
    background: #216103;
    height:100vh;
    padding-top:20px;
}

.sidebar a {
    display:block;
    color:white;
    padding:12px;
    text-decoration:none;
}

.btn {
    border-radius: 15pc;
    height: 50px;
}
.subject-area {
    padding: 10px;
    background-color: #c9e2be;
    width: 30%;
}

.subject-area button {
   border-radius: 10px;
   height: 30px;
   margin-left: 35px;
}
.card {
    background: #f5f5f5;
    padding: 15px;
    margin: 10px 0;
    border-radius: 8px;
}
</style>
</head>

<body>
    <div class="header">
    <h2>Subjects</h2>
</div>
<div class="container">
    <div class="sidebar">
        <a href="dashboard_prof.php">Dashboard</a>
        <a href="PSubjects.php">Subjects</a>
        <a href="#">Assignements</a>
        <a href="#">Grades</a>
        <a href="Choose_role.php">Logout</a>
     

</div>
<div class="subject-area">

<?php if ($role == "professor"): ?>

    <!-- 👨‍🏫 PROFESSOR UI -->
    <h2>Your Classes</h2>

    <form method="POST" action="CreateClass.php">
        <button type="submit">+ Create Class</button>
    </form>
</div> 
   

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

    <!-- 👨‍🎓 STUDENT UI -->
    <h2>My Subjects</h2>

    <form method="POST" action="join_class.php">
        <input type="text" name="class_code" placeholder="Enter class code">
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
    </body>
</html>
