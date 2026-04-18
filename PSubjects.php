<?php

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
.card {
    background-color: #f4f6f9;
    padding: 10px;

}
.btn {
    border-radius: 15pc;
    height: 50px;
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
 <div class="card">
      
      <a href="CreateClass.php"><button class="btn">CREATE SUBJECT</button></a>

 </div>
</div>
    
    
    </body>
</html>
