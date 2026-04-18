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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    text-decoration: none;
}

.sidebar a:hover {
   background: #1abc9c;
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
    box-shadow: 2px 2px 2px #bbc4d1;
}
h2 {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-weight: bold;
    font-size: 20px;
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
    <a href="PSubjects.php">Subjects</a>
    <a href="#">Assignments</a>
    <a href="#">Grades</a>
    <a href="Choose_role.php">Logout</a>
</div>

<div class="content">

<div class="card">
    <h3>Welcome Professor</h3>
    <h2><?php echo $_SESSION['name']; ?></h2>
    <p><?php echo $_SESSION['email']; ?></p>
</div>

</div>

</div>

</body>
</html>