<?php
require_once "config.inc.php";

print $htmlheader;

foreach ($LOGFILELIST as $i)
    print "<a style=\"color:yellow\" href=\"readlog.php?logfile=" . $i . "\">" . $i . "</a><br/>";

print $htmltail;

?>
