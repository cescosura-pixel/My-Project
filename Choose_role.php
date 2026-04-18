<!DOCTYPE html>
<html>
<head>
    <title>Choose Role</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f0fdf4; /* light green background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            width: 325px;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-top: 5px solid #16a34a; /* green primary */
            text-align: center;
        }

        h2 {
            color: #16a34a;
            margin-bottom: 20px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px 5px 12px 5px;
            margin: 10px 0;
            text-decoration: none;
            color: white;
            background: #16a34a;
            border-radius: 8px;
            font-size: 16px;
            transition: 0.2s;
        }

        .btn:hover {
            background: #15803d;
        }

        .btn.secondary {
            background: #16a34a;
        }

        .btn.secondary:hover {
            background: #16a34a;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>Select Role</h2>

    <!-- Student -->
    <a class="btn" href="login.php?role=student">
        👨‍🎓 Student
    </a>

    <!-- Professor -->
    <a class="btn secondary" href="login.php?role=professor">
        👨‍🏫 Professor
    </a>

</div>

</body>
</html>