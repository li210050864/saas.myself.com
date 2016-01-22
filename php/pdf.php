<?php
	set_time_limit(0);
	$name = $_POST['name'];
	$score = $_POST['score'];
	function pdf_replace($pattern,$replacement,$string){
		$len = strlen($pattern);
		$regexp = '';
		for($i=0;$i<$len;$i++){
			$regexp .=$pattern[$i];
			if($i<$len-1){
				$regexp .= "(\)\-{0,1}[0-9]*\(){0,1}";	
			}	
		}
		return preg_replace($regexp,$replacement,$string);	
	}
	if(!$name || !$score){
		echo "<h1>Error:</h1>";	
		echo "<p>This page was called incorrectly</p>";
	}else{
		//header("Content-type:application/pdf");
		//header("Content-Disposition:filename=cert.pdf");
		$date = date("F d,Y");
		$filename = "PDFCertification.pdf";
		$fp = fopen($filename,'rb');
		$output = fread($fp,filesize($filename));
		fclose($fp);
		$output = str_replace('<<NAME>>',$name,$output);	
		$output = str_replace('<<Name>>',$name,$output);	
		$output = str_replace('<<score>>',$score,$output);	
		$output = str_replace('<<mm/dd/yyyy>>',$date,$output);	
		echo $output;
	}
?>