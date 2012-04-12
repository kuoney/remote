<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<html>
<head>
	<title>Web Remote</title>
</head>
<body>
<?php
function send_command($button, $cmd, $fh)
{
	if (!empty($_POST[$button])) {
		fwrite($fh, $cmd);
		$ret = fgets($fh);

		if ($ret === "OK\n") {
			return "height:80px; width:150px; background-color:#008000";
		} else if ($ret === "ERR\n") {
			return "height:80px; width:150px; background-color:#ff0000";
		}
		return "height:80px; width:150px; background-color:#008ccc";
	}
	return "height:80px; width:150px; background-color:#add8e6";
}

$style = array(
	"height:80px; width:150px; background-color:#add8e6",
	"height:80px; width:150px; background-color:#add8e6",
	"height:80px; width:150px; background-color:#add8e6",
	"height:80px; width:150px; background-color:#add8e6",
);

$out = "/dev/ttyUSB0";
$fh = fopen($out, 'r+') or die("File open error");

$style[0] = send_command('power_on', "POWR1   \n", $fh);
send_command('power_off', "RSPW1   \n", $fh); /* make sure we can wake it back up */
usleep(500000);
$style[1] = send_command('power_off', "POWR0   \n", $fh);
$style[2] = send_command('chup', "CHUP1   \n", $fh);
$style[3] = send_command('chdw', "CHDW1   \n", $fh);

fclose($fh);
?>
<form method="post">
	<input type="submit" style="<?php echo $style[0]; ?>" name="power_on" value="Power On" />
	<input type="submit" style="<?php echo $style[1]; ?>" name="power_off" value="Power Off" />
	<br><br>
	<input type="submit" style="<?php echo $style[2]; ?>" name="chup" value="Channel Up" />
	<input type="submit" style="<?php echo $style[3]; ?>" name="chdw" value="Channel Down" />
</form>
</body></html>
