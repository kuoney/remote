<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<link rel="apple-touch-icon" href="./remote.png" />

<html>
<head>
        <title>Web Remote</title>
</head>
<style>
.outer {
    width: 310px;
    margin: auto;
    float: left;
    clear: left;
}
.container {
    position:relative;
    height:85px;
    width:155px;
    margin:0 auto;
    float:left;
}
.container2 {
    position:relative;
    height:85px;
    width:77px;
    margin:0 auto;
    float:left;
}
.caption {
    position:absolute;
    padding:1px;
    top:35%;
    width: 200%;
    left: -50%;
    color: black;
    font: 14px Helvetica, Sans-Serif;
    text-align:center;
}
.wraptocenter .wrimg {
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    width: 155px;
    height: 85px;
}
.wraptocenter2 .wrimg2 {
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    width: 77px;
    height: 85px;
}
.wraptocenter .wrapcenter2 * {
    vertical-align: middle;
}
.wraptocenter .wrapcenter2 {
    display: block;
}
.wraptocenter .wrapcenter2 span {
    display: inline-block;
    height: 100%;
    width: 1px;
}
.wraptocenter .wrimg img  {
    max-width:155px;
    max-height:85px;
}
.wraptocenter2 .wrimg2 img  {
    max-width:77px;
    max-height:85px;
}
.shrinkwrapImage {
    border-radius:0.5em;
    position : relative;
    display: inline-block;
    overflow: hidden;
}
</style>
<body bgcolor="#669999">
<?php
function send_command($button, $cmd, $fh)
{
        if (!empty($_POST[$button . '_x'])) {
                fwrite($fh, $cmd);
                $ret = fgets($fh);

                if ($ret === "OK\n") {
                        return "./buttons/green.png";
                } else if ($ret === "ERR\n") {
                        return "./buttons/red.png";
                }
                return "./buttons/yellow.png";
        }
        return "./buttons/yellow.png";
}
$out = "/dev/ttyUSB0";
$fh = fopen($out, 'w+') or print_r(error_get_last()) & die();

$button = array_fill(0, 12, "./buttons/yellow.png");
$i = -1;
$button[++$i] = send_command('power_on', "POWR1   \n", $fh);
$button[++$i] = send_command('power_off', "POWR0   \n", $fh);
$button[++$i] = send_command('chup', "CHUP1   \n", $fh);
$button[++$i] = send_command('chdw', "CHDW1   \n", $fh);
$button[++$i] = send_command('nbc', "DA2P1701\n", $fh);
$button[++$i] = send_command('abc', "DA2P1101\n", $fh);
$button[++$i] = send_command('fox', "DA2P5001\n", $fh);
$button[++$i] = send_command('cbs', "DA2P0501\n", $fh);
$button[++$i] = send_command('tv', "ITVD0   \n", $fh);
$button[++$i] = send_command('appletv', "IAVD6   \n", $fh);
$button[++$i] = send_command('dvd', "IAVD7   \n", $fh);
$button[++$i] = send_command('chrome', "IAVD8   \n", $fh);

fclose($fh);
?>
<form method="post">
<div class="outer">
    <div class="container">
        <div class="wraptocenter"> <span class="wrimg">
                <div class="shrinkwrapImage">
                    <div id="caption1" class="caption">Power On</div>
                    <input type="image" name= 'power_on' value='power_on' src="<?php echo $button[0]; ?>" style="height:80px; width:150px" />
                </div>
            </span>

        </div>
    </div>
    <div class="container">
        <div class="wraptocenter"> <span class="wrimg">
                <div class="shrinkwrapImage">
                    <div id="caption2" class="caption">Power Off</div>
                    <input type="image" name='power_off' value='power_off' src="<?php echo $button[1]; ?>" style="height:80px; width:150px" />
                </div>
            </span>
        </div>
    </div>
</div>



<div class="outer">
    <div class="container2">
        <div class="wraptocenter2"> <span class="wrimg2">
                <div class="shrinkwrapImage">
                    <div id="caption1" class="caption">TV</div>
                    <input type="image" name='tv' value='tv' src="<?php echo $button[8]; ?>" style="height:80px; width:75px" />
                </div>
            </span>

        </div>
    </div>
    <div class="container2">
        <div class="wraptocenter2"> <span class="wrimg2">
                <div class="shrinkwrapImage">
                    <div id="caption1" class="caption">Apple TV</div>
                    <input type="image" name='appletv' value='appletv' src="<?php echo $button[9]; ?>" style="height:80px; width:75px" />
                </div>
            </span>

        </div>
    </div>
    <div class="container2">
        <div class="wraptocenter2"> <span class="wrimg2">
                <div class="shrinkwrapImage">
                    <div id="caption1" class="caption">DVD</div>
                    <input type="image" name='dvd' value='dvd' src="<?php echo $button[10]; ?>" style="height:80px; width:75px" />
                </div>
            </span>

        </div>
    </div>
    <div class="container2">
        <div class="wraptocenter2"> <span class="wrimg2">
                <div class="shrinkwrapImage">
                    <div id="caption1" class="caption">Chrome</div>
                    <input type="image" name='chrome' value='chrome' src="<?php echo $button[11]; ?>" style="height:80px; width:75px" />
                </div>
            </span>

        </div>
    </div>
</div>

<div class="outer">
    <div class="container">
        <div class="wraptocenter"> <span class="wrimg">
                <div class="shrinkwrapImage">
                    <div id="caption1" class="caption">Channel Up</div>
                    <input type="image" name='chup' value='chup' src="<?php echo $button[2]; ?>" style="height:80px; width:150px" />
                </div>
            </span>

        </div>
    </div>
    <div class="container">
        <div class="wraptocenter"> <span class="wrimg">
                <div class="shrinkwrapImage">
                    <div id="caption2" class="caption">Channel Down</div>
                    <input type="image" name='chdw' value='chdw' src="<?php echo $button[3]; ?>" style="height:80px; width:150px" />
                </div>
            </span>
        </div>
    </div>
</div>


<div class="outer">
    <div class="container">
        <div class="wraptocenter"> <span class="wrimg">
                <div class="shrinkwrapImage">
                    <div id="caption1" class="caption">NBC</div>
                    <input type="image" name='nbc' value='nbc' src="<?php echo $button[4]; ?>" style="height:80px; width:150px" />
                </div>
            </span>

        </div>
    </div>
    <div class="container">
        <div class="wraptocenter"> <span class="wrimg">
                <div class="shrinkwrapImage">
                    <div id="caption2" class="caption">ABC</div>
                    <input type="image" name='abc' value='abc' src="<?php echo $button[5]; ?>" style="height:80px; width:150px" />
                </div>
            </span>
        </div>
    </div>
</div>



<div class="outer">
    <div class="container">
        <div class="wraptocenter"> <span class="wrimg">
                <div class="shrinkwrapImage">
                    <div id="caption1" class="caption">Fox</div>
                    <input type="image" name='fox' value='fox' src="<?php echo $button[6]; ?>" style="height:80px; width:150px" />
                </div>
            </span>

        </div>
    </div>
    <div class="container">
        <div class="wraptocenter"> <span class="wrimg">
                <div class="shrinkwrapImage">
                    <div id="caption2" class="caption">CBS</div>
                    <input type="image" name='cbs' value='cbs' src="<?php echo $button[7]; ?>" style="height:80px; width:150px" />
                </div>
            </span>
        </div>
    </div>
</div>
</form></body></html>
