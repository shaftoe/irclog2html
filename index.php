<?php
$MYLOGFILE = "<FULL PATH TO YOUR EGGDROP LOG HERE>";
$BACKGROUNDCOLOR = "#333";
$USERMESSAGECOLOR = "#fff";
$CHANNELCOLOR = "red";
$ACTIONCOLOR = "purple";
$OTHERCOLOR = "green";
$TIMESTAMPCOLOR = "grey";

print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n<html>\n<head>\n    <title>Irc2Log</title>\n    " . '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />' . "\n</head>\n<body style=\"background:$BACKGROUNDCOLOR\">\n";

$logfile = @fopen($MYLOGFILE, "r");

if ($logfile) {

    while (($buffer = fgets($logfile)) !== false) {
        $logline = htmlspecialchars($buffer); # parse text to html
        $timestamp = "<span style=\"color:$TIMESTAMPCOLOR\">" . substr( $logline, 0, 7 ) . "</span>&nbsp;";

        print "    <p class=\"";

        # choose what kind of message it is
        if ( substr($buffer, 8, 1) == "<" )
            print "usermessage\" style=\"color:$USERMESSAGECOLOR\">" . $timestamp . substr( $logline, 8, -1 ); 
        elseif ( substr($buffer, 8, 1) == "#" )
            print "channelmessage\" style=\"color:$CHANNELCOLOR\">" . $timestamp . substr( $logline, 8, -1 );
        elseif ( substr($buffer, 8, 1) == "A" ) {
            print "actionmessage\" style=\"color:$ACTIONCOLOR\">" . $timestamp . substr( $logline, 16, -1 );
        }
        else {
            print "othermessage\" style=\"color:$OTHERCOLOR\">" . $timestamp . substr( $logline, 8, -1 );
        }
    print "</p>\n";
    }
    
    if (!feof($logfile)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($logfile);
}

print "</body>\n</html>";

?>
