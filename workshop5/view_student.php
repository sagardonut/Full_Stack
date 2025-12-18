<?php include 'includes/header.php'; ?>

<main> 
	<h1>Students detail :</h1>
</main>

<?php
try{
	$fileName = "data/students.txt";
	$content = file_get_contents($fileName);

	if( $content !== false){
		echo "student : $content";
		echo " ";
	}

}catch(Exception $e) {
	echo "No data found !";
}
?>


<main>

</main>

<?php include 'includes/footer.php';?>