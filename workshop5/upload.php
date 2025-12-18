

<?php include 'includes/header.php'; ?>

	<style>
		form{
			margin: 50% auto;
			font-family: sans-serif;
			font-size: 2rem;
		}
		input{
			width: 50%;
			height: 40px;
			font-family: sans-serif;
			font-size: 20px;
			font-weight: bolder;
			border-radius: 20px;


		}
	</style>

	<form method="post" enctype="multipart/form-data">
		<input type="file" name="upload">
		<input style="background-color: blanchedalmond;" type="submit" name="submit" placeholder="submit">
	</form>

	<?php

	$serverMethod = $_SERVER["REQUEST_METHOD"] == "POST";
	if($serverMethod){
		$upload_destination = "uploads/";
		$fileName = basename($_FILES['upload']['name']);
		$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
		$targetFile = $upload_destination . $fileName;
		$tempFile = $_FILES["upload"]["tmp_name"];

		$file_type = ["pdf","jpg","png"];

		if(!in_array($fileExt, $file_type)){
			die("Unsupported File type , try uploading a png , jpg or pdf ");
		}
		if(move_uploaded_file($tempFile, $targetFile)){
			echo "File uploaded successfully.";
		}

	}

	include 'includes/footer.php';
	
	?>
