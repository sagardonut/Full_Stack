<?php include 'includes/header.php'; ?>
	 <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .addstudentform {
            width: 400px;
            margin: 80px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .addstudentform h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #1e3a8a;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #1e3a8a;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #1e3a8a;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #163172;
        }
    </style>
    <main>
	<div class="addstudentform">
	<form method="post" action="#">

		<label>Name: </label>
		<input type="text" name="username" required> <br> <br>

		<label>Email: </label>
		<input type="email" name="email" required> <br><br>

		<label>Skills: </label>
		<input type="text" name="skill" required> <br><br>

		<input type="submit" placeholder="Submit ">
	</form>
	</div>
    </main>

<?php 
    
    function save_in_txt ($user, $email, $arr){
        try {
            $skills = json_encode($arr);
            $fr = fopen("data/students.txt", "a");
            $content ="\n $user  $email  $skills";
            fwrite($fr, $content);
            echo "sucessfully added ! ";
        } catch (Exception $e) {
            echo "Failed to save data in file.";
            echo " Error : ".$e;
        }
        
    }

	if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $skill = $_POST['skill'];

        $array_skill = explode(" ", $skill);
        save_in_txt($username, $email, $array_skill);

    }

    include 'includes/footer.php';
?>
