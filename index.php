<?php
require_once "config.inc.php";

print $htmlheader;

$count = 0;
foreach ($LOGFILELIST as $i) {
    print "<p><a style=\"color:yellow\" href=\"readlog.php?logfile=" . $count . "\">" . $i . "</a></p>";
    $count += 1;
}

print $htmltail;

?>
