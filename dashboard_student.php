<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

/* MENU BUTTON (mobile only) */
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

/* SIDEBAR LINKS */
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

/* CARD */
.card {
    background: white;
    padding: 20px;
    margin-bottom: 15px;
    border-radius: 10px;
    box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
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
    <h2>Student Dashboard</h2>
</div>

<div class="container">

    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar">
        <a href="#">Dashboard</a>
        <a href="PSubjects.php">Subjects</a>
        <a href="#">Assignments</a>
        <a href="#">Grades</a>
        <a href="Choose_role.php">Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="card">
            <h3>Welcome Student</h3>
            <h2><?php echo $_SESSION['name']; ?></h2>
            <p><?php echo $_SESSION['email']; ?></p>
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