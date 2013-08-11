

	<?php
	require('fpdf.php');

	class PDF extends FPDF
	{
	// Load data
	function LoadData($file)
	{
		// Read file lines
		$lines = file($file);
		$data = array();
		foreach($lines as $line)
			$data[] = explode(';',trim($line));
		return $data;
	}

	// Simple table
	function qrTable($qr_txt)
	{
		// Data
		$HW = 25;
		$i=1;
		$X = 5;
		$Y = 10;
		for($r = 1; $r <= 125; $r++)
		{		
			for($c = 1; $c <= 8; $c++) 
			{
				$url = 'https://chart.googleapis.com/chart?chs=100x100&cht=qr&chld=L|0&chl='.
							$qr_txt.str_pad($i, 4, '0', STR_PAD_LEFT);
				$img = 'tmp/'.$qr_txt.str_pad($i, 4, '0', STR_PAD_LEFT).'.png';			
				
				$data = file_get_contents($url);
				$f = fopen($img, 'w');
				fwrite($f, $data);
				fclose($f);
				
							
				//$this->Cell($HW, $HW,$this->Image("bbao0001.png",$X,$Y, $HW, $HW), 1, 0,'L', false);	
				$this->Image($img,$X,$Y, $HW, $HW);
				$X = $X+$HW;		
				$i++;
			}
			$Y = $Y+$HW;
			$X = 5;
			//$this->Ln();
			if ($r%11==0)
			{
				$this->AddPage();
				$X = 5;
				$Y = 10;
			}
				
		}
	}

	 
	 
	}


	if (isset($_POST) && isset($_POST['qr_txt']) && $_POST['qr_txt']!="" )
		$qr_txt = str_replace(' ', '', $_POST['qr_txt']); 
	else
		die('<!DOCTYPE html> <html><head> <title>QR code form generator</title> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"/><meta name="description" content="" /><link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  <!-- KICKSTART --> <link rel="stylesheet" type="text/css" href="style.css" media="all" />                          <!-- CUSTOM STYLES --> <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> <script type="text/javascript" src="js/kickstart.js"></script>                                  <!-- KICKSTART --></head><body> <br><br> <div class="grid"> <!-- ===================================== END HEADER ===================================== -->Empty fields! <a href="form.php">Go back</a></body> </html>');
	
		
	$pdf = new PDF();
	$pdf->SetMargins(5, 25, 5);
	$pdf->AddPage();
	//reporting 
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(10,10," - Word : $qr_txt");$pdf->Ln();
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(10,10,"- Start from : " . $qr_txt.str_pad(0, 4, '0', STR_PAD_LEFT) );$pdf->Ln();
	$pdf->Cell(10,10,"- End on : " . $qr_txt.str_pad(1000, 4, '0', STR_PAD_LEFT) );$pdf->Ln();
	$pdf->Cell(10,10,"- Use Ctrl+S to save file or Ctrl+P to print it!");$pdf->Ln();
	
	
	$pdf->AddPage();
	$pdf->qrTable($qr_txt);

	$pdf->Output();
	//clean up mess
	$files = glob('tmp/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}
	?>


