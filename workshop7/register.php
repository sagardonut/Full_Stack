<?php

require 'db.php';

try{
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['add_student'])){
        
        $student_id = $_POST['student_id'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        $hashedPassword= password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO students (student_id, full_name, password_hash) VALUES(?,?,?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([$student_id,$name, $hashedPassword]);

        header("Refresh:2, url=login.php");

}
}catch(PDOException $e){
    die("Database error".$e->getMessage());
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f2f4f7;
    }

    h1 {
        text-align: center;
        margin-top: 50px;
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
        background: #007bff;
        color: #fff;
        font-size: 15px;
        cursor: pointer;
    }

    button:hover {
        background: #0056b3;
    }

    .login-btn {
        background: #28a745;
        margin-top: 10px;
    }

    .login-btn:hover {
        background: #1e7e34;
    }
</style>

</head>
<body>
    <h1>Create a new Account: </h1>
    <div class="form-container">
        <form method="POST">
            <label for="student_id">Student ID</label>
            <input type="text" id="student_id" name="student_id" required>

            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button name="add_student" type="submit">Submit</button>
            <a href="login.php">
        <button type="button" class="login-btn"> Already have an account </button>
    </a>
        </form>
    </div>

</body>
</html>
