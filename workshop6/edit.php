<?php 
	require "db.php";


	$id = $_GET['id'];
	$sql = "SELECT * FROM students where id=$id";
	$stml = $pdo ->query($sql);
	$details = $stml -> fetchAll();
	// var_dump($details[0]["email"]);

	try{
		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit_student'])){

			$name = $_POST['name'];
			$email = $_POST['email'];
			$course = $_POST['course'];
			$id = $_POST['id'];

			$sql = "UPDATE students SET name=:name, email =:email, course =:course WHERE id = :id";

			$smpt = $pdo -> prepare($sql);
			$smpt -> execute([
				':name' => $name,
				':email' => $email,
				':course' => $course,
				':id' => $id
			]);
			// echo "Updating student: name=$name, email=$email, course=$course, id=$id";

			// echo "Affected rows: " . $smpt->rowCount();

			echo "Student updated successfully";
   			header("Location: index.php");
			exit;

		}


	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit | student detail </title>
</head>
<body>
	<h1>Edit the student details </h1>
<form method="POST">
		<input type="hidden" name="id"  value="<?php echo $details[0]["id"]?>" ><br>
        Name:<input type="text" name="name" required value="<?php echo $details[0]["name"] ?>" ><br>
        Email:<input type="email" name="email" required value="<?php echo $details[0]['email']?>" ><br>
        Course:<input type="text" name="course" required value= "<?php echo $details[0]["course"] ?>"><br>
        <button type="submit" name="edit_student">Save changes</button>
    </form>
</body>
</html>