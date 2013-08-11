<!DOCTYPE html>
<html><head>
<title>HTML KickStart Elements</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="" />
<link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="style.css" media="all" />                          <!-- CUSTOM STYLES -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="js/kickstart.js"></script>                                  <!-- KICKSTART -->
</head><body>
<br><br>
<div class="grid">
<!-- ===================================== END HEADER ===================================== -->

		<?php
		if (isset($_POST) && isset($_POST['qr_txt']) && $_POST['qr_txt']!="" )
			$qr_txt = $_POST['qr_txt'];
		else
			die("Empty fields! <a href='form.php'>Go back</a>");
			
		
		require_once 'PHPWord.php';
		// New Word Document
		$PHPWord = new PHPWord();
		// New portrait section
		$section = $PHPWord->createSection();
		$section->getSettings()->setMarginLeft(100); 
		$section->getSettings()->setMarginRight(150); 
		$section->getSettings()->setMarginTop(150); 
		$section->getSettings()->setMarginBottom(150); 
		// Add table
		//$tableStyle = array('cellMarginTop'=>0, 'cellMarginLeft'=>0, 'cellMarginRight'=>0, 'cellMarginBottom'=>0);
		//$table = $section->addTable($tableStyle);
		$table = $section->addTable();
		$i = 1 ;
		//reporting
		$report .= "Word : $qr_txt<br>";
		$report .= "Start from : " . $qr_txt.str_pad($i, 4, '0', STR_PAD_LEFT)."<br>";
		for($r = 1; $r <= 2; $r++) { // Loop through rows
			// Add row
			$table->addRow();	
			for($c = 1; $c <= 8; $c++) { // Loop through cells
				// Add Cell
				$url = 'https://chart.googleapis.com/chart?chs=100x100&cht=qr&chld=L|2&chl='.
							$qr_txt.str_pad($i, 4, '0', STR_PAD_LEFT);
				$img = 'tmp/'.$qr_txt.str_pad($i, 4, '0', STR_PAD_LEFT).'.jpg';
				file_put_contents($img, file_get_contents($url));
				$table->addCell(60)->addImage($img);
				$i++;
			}
		}
		//reporting
		$report .= "End on : " . $qr_txt.str_pad($i-1, 4, '0', STR_PAD_LEFT)."<br>";		
		// Save File
		$docName = uniqid() .".docx";
		$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
		$objWriter->save($docName);
		//reporting
		$report .= '<a href="'.$docName.'">Click to download file</a><br><a href="form.php">Click to generate new codes!</a>';		
		echo $report ; 		
		//clean up mess
		$files = glob('tmp/*'); // get all file names
		foreach($files as $file){ // iterate files
		  if(is_file($file))
			unlink($file); // delete file
		}
		?>

</body>
</html>
