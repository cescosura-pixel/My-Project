<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'professor') {
    header("Location: Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Professor Dashboard</title>

<style>
body {
    margin:0;
    font-family: Arial;
    background:#f4f6f9;
}

.header {
    background:#8e44ad;
    color:white;
    padding:15px;
    text-align:center;
}

.container {
    display:flex;
}

.sidebar {
    width:200px;
    background:#5e3370;
    height:100vh;
    padding-top:20px;
}

.sidebar a {
    display:block;
    color:white;
    padding:12px;
}

.sidebar a:hover {
    background:#9b59b6;
}

.content {
    flex:1;
    padding:20px;
}

.card {
    background:white;
    padding:20px;
    margin-bottom:15px;
    border-radius:10px;
}
</style>

</head>

<body>

<div class="header">
    <h2>Professor Dashboard</h2>
</div>

<div class="container">

<div class="sidebar">
    <a href="#">Dashboard</a>
    <a href="#">Subjects</a>
    <a href="#">Assignments</a>
    <a href="#">Grades</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">

<div class="card">
    <h3>Welcome Professor</h3>
    <p><?php echo $_SESSION['email']; ?></p>
</div>

</div>

</div>

</body>
</html>