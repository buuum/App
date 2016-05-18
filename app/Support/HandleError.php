<?php

namespace Application\Support;

use Buuum\HandleErrorInterface;

class HandleError implements HandleErrorInterface
{

    private $logPath;
    private $debugMode;

    public function __construct($debugmode, $logPath = null)
    {
        $this->logPath = $logPath;
        $this->debugMode = $debugmode;
    }

    public function getDebugMode()
    {
        return $this->debugMode;
    }

    public function parseError($errtype, $errno, $errmsg, $filename, $linenum)
    {

        $err = "<errorentry>\n";
        $err .= "\t<datetime>" . date("Y-m-d H:i:s (T)") . "</datetime>\n";
        $err .= "\t<errornum>" . $errno . "</errornum>\n";
        $err .= "\t<errortype>" . $errtype . "</errortype>\n";
        $err .= "\t<errormsg>" . $errmsg . "</errormsg>\n";
        $err .= "\t<scriptname>" . $filename . "</scriptname>\n";
        $err .= "\t<scriptlinenum>" . $linenum . "</scriptlinenum>\n";

        $err .= "</errorentry>\n\n";

        error_log($err, 3, $this->logPath . "/error.log");

    }
}