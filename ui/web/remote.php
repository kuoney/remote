<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<html>
<head>
	<title>Web Remote</title>
</head>
<body>
<?php
function send_command($button, $cmd, $fh, $width)
{
	if (!empty($_POST[$button])) {
		fwrite($fh, $cmd);
		$ret = fgets($fh);

		if ($ret === "OK\n") {
			return "height:80px; width:${width}px; background-color:#008000";
		} else if ($ret === "ERR\n") {
			return "height:80px; width:${width}px; background-color:#ff0000";
		}
		return "height:80px; width:${width}px; background-color:#008ccc";
	}
	return "height:80px; width:${width}px; background-color:#add8e6";
}

$style = array_fill(0, 8, "height:80px; width:150px; background-color:#add8e6");
$style = array_fill(8, 3, "height:80px; width:90px; background-color:#add8e6");

$out = "/dev/ttyUSB0";
$fh = fopen($out, 'r+') or die("File open error");

$style[0] = send_command('power_on', "POWR1   \n", $fh, 150);
$style[1] = send_command('power_off', "POWR0   \n", $fh, 150);
$style[2] = send_command('chup', "CHUP1   \n", $fh, 150);
$style[3] = send_command('chdw', "CHDW1   \n", $fh, 150);
$style[4] = send_command('nbc', "DA2P1701\n", $fh, 150);
$style[5] = send_command('abc', "DA2P1101\n", $fh, 150);
$style[6] = send_command('fox', "DA2P5001\n", $fh, 150);
$style[7] = send_command('cbs', "DA2P0501\n", $fh, 150);
$style[8] = send_command('tv', "ITVD0   \n", $fh, 90);
$style[9] = send_command('iphone', "IAVD1   \n", $fh, 90);
$style[10] = send_command('dvd', "IAVD9   \n", $fh, 90);

fclose($fh);
?>
<form method="post">
	<input type="submit" style="<?php echo $style[0]; ?>" name="power_on" value="Power On" />
	<input type="submit" style="<?php echo $style[1]; ?>" name="power_off" value="Power Off" />
	<br /><br />
	<input type="submit" style="<?php echo $style[2]; ?>" name="chup" value="Channel Up" />
	<input type="submit" style="<?php echo $style[3]; ?>" name="chdw" value="Channel Down" />
	<br /><hr />
	<p font=verdana> Popular Channels </p>
	<input type="submit" style="<?php echo $style[4]; ?>" name="nbc" value="NBC" />
	<input type="submit" style="<?php echo $style[5]; ?>" name="abc" value="ABC" />
	<br /><br />
	<input type="submit" style="<?php echo $style[6]; ?>" name="fox" value="FOX" />
	<input type="submit" style="<?php echo $style[7]; ?>" name="cbs" value="CBS" />
	<br /><hr />
	<p font=verdana> Input Selection </p>
	<input type="submit" style="<?php echo $style[8]; ?>" name="tv" value="TV" />
	<input type="submit" style="<?php echo $style[9]; ?>" name="iphone" value="IPHONE" />
	<input type="submit" style="<?php echo $style[10]; ?>" name="dvd" value="DVD" />
</form>
</body></html>
