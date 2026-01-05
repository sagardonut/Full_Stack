<?php 

session_start();
$isUserLoggedIn = $_SESSION['logged_in'];
$student_id = $_SESSION['student_id'];

if(!$isUserLoggedIn){
	header("Location: login.php");
}

$theme = isset ($_COOKIE['theme'])? $_COOKIE['theme']:'dark';

if($theme==='dark') {
	$bg="#000";
	$color = "#fff";
}else{
	$bg="#fff";
	$color = "#000";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;

        background-color: <?= $bg ?>;
        color: <?= $color ?>;
       
        }

        .navbar {
            background: #007bff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
            font-size: 20px;
        }

        .logout-btn {
            background: #dc3545;
            border: none;
            color: white;
            padding: 8px 14px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-btn:hover {
            background: #b52a37;
        }

        .container {
            padding: 60px;
        }

        .welcome {
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        footer {
            text-align: center;
            padding: 15px;
            font-size: 13px;
        }
    </style>
</head>

<body bgcolor="<?= $bg?>">
    <div class="navbar">
        <h2>Student Dashboard</h2>

        <form method="GET" action="logout.php">
        	<button name="logout" class="logout-btn" >Logout</button>
        </form>
    </div>

    <div class="container">
        <div class="welcome">
            <h3>Welcome, <?=$student_id?>👋</h3>
            <p>You are logged in successfully.</p>
        </div>

    </div>

    <footer>
        © 2025 Student Portal
    </footer>

</body>
</html>
