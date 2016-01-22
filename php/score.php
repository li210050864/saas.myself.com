<?php
	$q1 = $_POST["q1"];
	$q2 = $_POST["q2"];
	$q3 = $_POST["q3"];
	$name = $_POST["name"];
	if($q1 == "" || $q2 == "" || $q3=="" || $name==""){
		echo "<h1><p align='center'><img src='images/logo.jpg' width='200' height='200'/>";
		echo "Sorry :";
		echo "</p>";
		echo "<p> You need to fill in your name and answore all questions.";
		echo "</p>";
	}else{
		$score = 0;
		if($q1 == 1){
			$score++;
		}
		if($q2 == 1){
			$score++;
		}
		if($q3 == 1){
			$score++;	
		}
		$score = $score/3*100;
		if($score < 50){
			echo "<h1><p align='center'><img src='images/logo.jpg' width='200' height='200'/>";
			echo "Sorry :";
			echo "</p></h1>";
			echo "<p> You need to score at least 50% to pass the exam.";
			echo "</p>";
		}else{
			echo "<h1><p align='center'><img src='images/logo.jpg' width='100' height='100'/>";
			echo "Congratulations!<img src='images/logo.jpg' width='100' height='100'/>";
			echo "</p></h1>";
			echo "<p> Well done ".$name.", with a score of ".$score."%,you have passed the exam.";
			echo "</p>";
			echo "<p>Please click here to download your certificate as a Microsoft World (RTF) file.</p>";
			echo "<form action='rtf.php' method='post'>";
			echo "<div align='center'><input type='image' src='images/logo.jpg' border='0' width='200' height='50'/></div>";
			echo "<input type='hidden' name='name' value='".$name."' />";
			echo "<input type='hidden' name='score' value='".$score."' />";
			echo "</form>";
			echo "<p>Please click here to download your certificate as a Portable Document Format (PDF) file.</p>";
			echo "<form action='pdf.php' method='post'>";
			echo "<div align='center'><input type='image' src='images/logo.jpg' border='0' width='200' height='50'/></div>";
			echo "<input type='hidden' name='name' value='".$name."' />";
			echo "<input type='hidden' name='score' value='".$score."' />";
			echo "</form>";
			echo "<p>Please click here to download your certificate as a Portable Document Format (PDF) file generated with PDFLib.</p>";
			echo "<form action='pdflib.php' method='post'>";
			echo "<div align='center'><input type='image' src='images/logo.jpg' border='0' width='200' height='50'/></div>";
			echo "<input type='hidden' name='name' value='".$name."' />";
			echo "<input type='hidden' name='score' value='".$score."' />";
			echo "</form>";
		}
	}
?>