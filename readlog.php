<?php
require_once "config.inc.php";

print $htmlheader;

print "<h2><a style=\"color:yellow\" href=\"index.php\">Back</a></h2>";

// a bit of sanity check on input 
if ( $_GET['logfile'] == '' ) {
    echo "<p>No logfile selected. Nothing to display</p>";
}
else {
    $MYLOGFILE = $LOGPATH . $LOGFILELIST[$_GET['logfile']];
    print $MYLOGFILE;

    // a bit of sanity check on input
    if ( strpos( $MYLOGFILE, '..' ) ) {
        print "<p style=\"color:$USERMESSAGECOLOR\">No hacking please... bye</p>";
        print $htmltail;
        exit(1);
    }    
    elseif ( ! $logfile = @fopen($MYLOGFILE, "r") ) {
        echo "<p style=\"color:$USERMESSAGECOLOR\">No such file</p>";
        print $htmltail;
        exit(1);
    }
    

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
}

print $htmltail;

?>
