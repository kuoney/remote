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

$data = $_POST['power_on'];

if (!empty($data)) {
	fwrite($fh, "POWR1   \n");
}

$data = $_POST['power_off'];

if (!empty($data)) {
	fwrite($fh, "POWR0   \n");
}

$data = $_POST['chup'];

if (!empty($data)) {
	fwrite($fh, "CHUP1   \n");
}

$data = $_POST['chdw'];

if (!empty($data)) {
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
