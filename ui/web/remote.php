<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<html>
<head>
	<title>Web Remote</title>
</head>
<body>
<?php
$out = "/dev/ttyUSB0";
$fh = fopen($out, 'w') or die("File open error");

if (!empty($_POST['power_on'])) {
	fwrite($fh, "POWR1   \n");
}

if (!empty($_POST['power_off'])) {
	fwrite($fh, "RSPW1   \n"); /* make sure we can wake it back up */
	usleep(500000);
	fwrite($fh, "POWR0   \n");
}

if (!empty($_POST['chup'])) {
	fwrite($fh, "CHUP1   \n");
}

if (!empty($_POST['chdw'])) {
	fwrite($fh, "CHDW1   \n");
}
fclose($fh);
?>
<form method="post">
	<input type="submit" style="height:80px; width:150px" name="power_on" value="Power On" />
	<input type="submit" style="height:80px; width:150px" name="power_off" value="Power Off" />
	<br><br>
	<input type="submit" style="height:80px; width:150px" name="chup" value="Channel Up" />
	<input type="submit" style="height:80px; width:150px" name="chdw" value="Channel Down" />
</form>
</body></html>
