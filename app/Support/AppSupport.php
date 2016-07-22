<?php

namespace App\Support;

use Buuum\Config;
use Sepia\FileHandler;
use Sepia\PoParser;

class AppSupport
{

    /**
     * @var Config
     */
    private static $config;

    public static function setConfig(Config $config)
    {
        self::$config = $config;
    }

    public static function initialize($request_path)
    {
        self::getScope($request_path);
        self::getLang($request_path);
    }

    public static function getScope($request_path)
    {
        $config = self::$config;
        $scopes = $config->get('scopes');

        if (!empty($scopes)) {
            foreach ($scopes as $scope => $prefix) {
                if ($prefix && substr($request_path, 0, strlen($prefix)) == $prefix) {
                    $config->set('scope', $scope);
                    return $scope;
                }
            }
        }

        return $config->get('scope');
    }

    public static function getLang($request_path)
    {
        if (substr($request_path, 0, 4) == '/en/') {
            self::loadLang('en_EN');
            setlocale(LC_CTYPE, "en_US.utf8");
            date_default_timezone_set("Europe/Madrid");
        } else {
            setlocale(LC_CTYPE, "es_ES.utf8");
            date_default_timezone_set("Europe/Madrid");
        }
    }

    public static function loadLang($lang)
    {
        $config = self::$config;
        $scope = $config->get('scope');
        $paths = $config->get('paths');

        $file = $paths['views'] . '/' . $scope . '/langs/' . $lang . '.po';
        if (file_exists($file)) {
            $fileHandler = new FileHandler($file);
            $poParser = new PoParser($fileHandler);
            $GLOBALS['traducciones'] = $poParser->parse();
        }

    }

}