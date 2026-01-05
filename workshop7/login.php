<?php

require 'db.php';

try{
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['login'])){

    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE student_id=?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$student_id]);

    $student = $stmt->fetch();

    if($student){
        
    $hashedPassword = $student['password_hash'];
    $isPasswordValid = password_verify($password, $hashedPassword);

    if($isPasswordValid){

    	session_start();
    	$_SESSION['logged_in'] = true;
    	$_SESSION['student_id'] = $student["student_id"];
        header("Location:dashboard.php");
    }else{
      echo "Invalid Password! Please try again.";
    }
    }else{
        echo "Invalid Student Id!";
    }
}
}catch(PDOException $e){
    die("Database error".$e->getMessage());
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f7;
        }

        h1 {
            text-align: center;
            margin-top: 60px;
            color: #333;
        }

        .form-container {
            width: 320px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 12px;
            font-size: 14px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            width: 100%;
            margin-top: 15px;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background: #28a745;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #1e7e34;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<h1>Login Student</h1>

<div class="form-container">
    <form method="POST">
        <label>Student ID</label>
        <input type="text" name="student_id" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <div class="register-link">
        <a href="register.php">Create New Account</a>
    </div>
</div>

</body>
</html>
