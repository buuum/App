<?php
namespace Application\Helper;

class Config
{

    private $configs = [];
    private $paths = [];

    private $debugMode = true;
    private static $tempfolder;

    public function __construct($paths)
    {
        $this->paths = $paths;
        $this->configs = include_once $this->paths['config'];
        $this->configs['version'] = json_decode(file_get_contents($this->paths['version']), true);
        $this->setupErrors();
    }


    public function get($name)
    {
        if (!empty($this->configs[$name])) {
            return $this->configs[$name];
        } elseif (strpos($name, '.') !== false) {
            $loc = &$this->configs;
            foreach (explode('.', $name) as $part) {
                $loc = &$loc[$part];
            }
            return $loc;
        }
        return false;
    }

    public function set($name, $value)
    {
        $this->configs[$name] = $value;
    }

    public function getHost()
    {
        return $this->configs[$this->configs['environment']]['host'];
    }

    public function getDatabase()
    {
        return $this->configs[$this->configs['environment']]['bbdd'];
    }

    public function cssjsVersion()
    {
        return !empty($this->configs['version']) ? $this->configs['version']['version'] : time();
    }

    private function setupErrors()
    {
        self::$tempfolder = $this->paths['log'];
        $this->debugMode = $this->configs[$this->configs['environment']]['development'];

        //set_exception_handler(array(__CLASS__, 'handleException'));
        if (!$this->debugMode) {
            set_error_handler(array(__CLASS__, "handleErrors"));
            register_shutdown_function(array(__CLASS__, "shutdownFunction"));
        }

        //require_once __DIR__ . '/../Utils/exceptions.php';
        $display_errors = $this->debugMode ? "1" : "0";
        error_reporting(E_ALL | E_STRICT);
        ini_set('display_errors', $display_errors);
        ini_set('html_errors', $display_errors);
    }

    static public function handleErrors($errno, $errmsg, $filename, $linenum, $vars)
    {
        if (0 == error_reporting()) {
            return true;
        }

        $dt = date("Y-m-d H:i:s (T)");

        $errortype = array(
            E_ERROR             => 'Error',
            E_WARNING           => 'Warning',
            E_PARSE             => 'Parsing Error',
            E_NOTICE            => 'Notice',
            E_CORE_ERROR        => 'Core Error',
            E_CORE_WARNING      => 'Core Warning',
            E_COMPILE_ERROR     => 'Compile Error',
            E_COMPILE_WARNING   => 'Compile Warning',
            E_USER_ERROR        => 'User Error',
            E_USER_WARNING      => 'User Warning',
            E_USER_NOTICE       => 'User Notice',
            E_STRICT            => 'Runtime Notice',
            E_RECOVERABLE_ERROR => 'Catchable Fatal Error'
        );

        $errtype = (isset($errortype[$errno])) ? $errortype[$errno] : '';

        $err = "<errorentry>\n";
        $err .= "\t<datetime>" . $dt . "</datetime>\n";
        $err .= "\t<errornum>" . $errno . "</errornum>\n";
        $err .= "\t<errortype>" . $errtype . "</errortype>\n";
        $err .= "\t<errormsg>" . $errmsg . "</errormsg>\n";
        $err .= "\t<scriptname>" . $filename . "</scriptname>\n";
        $err .= "\t<scriptlinenum>" . $linenum . "</scriptlinenum>\n";

        $err .= "</errorentry>\n\n";

        error_log($err, 3, self::$tempfolder . "/error.log");

        return true;
    }

    static public function shutdownFunction()
    {
        $error = error_get_last();

        // fatal error, E_ERROR === 1
        $save_errors = array(
            E_ERROR,
            E_CORE_ERROR,
            E_COMPILE_ERROR
        );
        if (in_array($error['type'], $save_errors)) {
            //do your stuff
            $errortypes = array(
                E_ERROR         => 'Fatal error',
                E_CORE_ERROR    => 'Fatal error (Core Error)',
                E_COMPILE_ERROR => 'Fatal error (Compile Error)'
            );
            $err = "<errorentry>\n";
            $err .= "\t<datetime>" . date("Y-m-d H:i:s (T)") . "</datetime>\n";
            $err .= "\t<errornum>" . $error['type'] . "</errornum>\n";
            $err .= "\t<errortype>" . $errortypes[$error['type']] . "</errortype>\n";
            $err .= "\t<errormsg>" . $error['message'] . "</errormsg>\n";
            $err .= "\t<scriptname>" . $error['file'] . "</scriptname>\n";
            $err .= "\t<scriptlinenum>" . $error['line'] . "</scriptlinenum>\n";
            $err .= "</errorentry>\n\n";
            error_log($err, 3, self::$tempfolder . "/error.log");

        }
    }


}