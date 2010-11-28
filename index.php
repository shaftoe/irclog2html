<?php
require_once "config.inc.php";

print $htmlheader;

print "<a style=\"color:yellow\" href=\"readlog.php?logfile=devsum.log" . "\">Devsum today</a><br/>";
print "<a style=\"color:yellow\" href=\"readlog.php?logfile=devsum.log.yesterday" . "\">Devsum yesterday</a>";

print $htmltail;

?>
