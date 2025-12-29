<?php

require 'db.php';
try{
    $sql = "SELECT * FROM students";
    $stmt = $pdo->query($sql);
    $students = $stmt->fetchAll();
}catch(PDOException $e){
    die("Unable to get students".$e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Database</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f8;
    padding: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #ccc;
}

th {
    background-color: #333;
    color: white;
}

tr:hover {
    background-color: #eee;
}

a {
    color: blue;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>


</head>
<body>
<h1 style='color:red;'>Welcome to Student Database!</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Edit</th>
        <th>Delete</th>

    </tr>
    <?php foreach ($students as $student):?>
        <tr>
            <td><?=$student['name']?></td>
            <td><?=$student['email']?></td>
            <td><?=$student['course']?></td>
            <td><a href="edit.php?id=<?=$student['id']?>">Edit</a></td>
            <td><a href="delete.php?id=<?=$student['id']?>">Delete</a></td>
        </tr>
    <?php endforeach ?>

</table>
</body>
</html>