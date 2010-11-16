<?php
$MYLOGFILE = "<FULL PATH TO YOUR EGGDROP LOG HERE>";
print "<html><head></head><body style=\"background:black\">\n";

$logfile = @fopen($MYLOGFILE, "r");

if ($logfile) {
    
    while (($buffer = fgets($logfile)) !== false) {
        $logline = htmlspecialchars($buffer); # parse text to html
        $timestamp = "<span style=\"color:grey\">" . substr( $logline, 0, 7 ) . "</span>&nbsp;";
        
        print "    <p class=\"";
        
        # choose what kind of message it is
        if ( substr($buffer, 8, 1) == "<" )
            print "usermessage\" style=\"color:white\">" . $timestamp . substr( $logline, 8, -1 ); 
        elseif ( substr($buffer, 8, 1) == "#" )
            print "channelmessage\" style=\"color:red\">" . $timestamp . substr( $logline, 8, -1 );
        elseif ( substr($buffer, 8, 1) == "A" ) {
            print "actionmessage\" style=\"color:purple\">" . $timestamp . substr( $logline, 16, -1 );
        }
        else {
            print "othermessage\" style=\"color:green\">" . $timestamp . substr( $logline, 8, -1 );
        }
    print "</p>\n";
    }
    
    if (!feof($logfile)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($logfile);
}
  
print "</body></html>";
  
?>
