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

<div class="grid">
<!-- ===================================== END HEADER ===================================== -->


	<!-- 
	
		ADD YOUR HTML ELEMENTS HERE
		
		Example: 2 Columns
	 -->

	<div class="col_12">
	<h1 class="center">
	<p><i class="icon-qrcode"></i></p></h1>
	<h4 style="color:#999;margin-bottom:40px;" class="center">
		<div style="width:450px; margin-bottom: 1em; padding: 10px; margin: auto;">
			<p>
				Encode a message or any form of text in a QR-Code.
			</p>
			<form method="post" action="form-process.php">
				<textarea name="qr_txt" style="width: 100%; height: 70px; margin-bottom: 5px;"></textarea>
				<br>
				<!--
				<input type="text" placeholder="Number of items" style="width: 100%" />
				<br>				
				<select style="width: 100%">
					<option>Size</option>
				</select>
				<br>
				-->
				<input style="width: 100%" class="submit-button" type="submit" value="Submit">
			</form>
		</div>	
	</h4>
	</div>

<!-- ===================================== START FOOTER ===================================== -->
</div><!-- END GRID-->

</body></html>