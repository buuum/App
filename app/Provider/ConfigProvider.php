<?php

namespace App\Provider;

use App\Helpers\AppHelper;
use App\Support\HandleError;
use Buuum\Config;
use Buuum\Encoding\Encode;
use League\Container\Container;
use Sepia\FileHandler;
use Sepia\PoParser;
use Symfony\Component\HttpFoundation\Request;

class ConfigProvider
{

    public function register(Container $app)
    {
        $app->share('config', function () use ($app) {
            $paths = $app->get('paths');

            $configs = require_once $paths['config'];
            $app_path = $paths['app'];

            $autoloads = [
                "files" => [$app_path . '/helpers.php'],
                //"psr-4" => [
                //    "App\\" => $app_path
                //]
            ];

            $config = new Config($configs, $autoloads);
            $request = $app->get('current_request');
            $environment = $this->getEnvironment(
                $request,
                $config->get('environments')
            );
            $config->set('environment', $environment ?: $config->get('environment'));

            $debugMode = $config->get('environment.development');
            $config->set("paths", $paths);

            $handle = new HandleError($debugMode, $paths['log']);
            $config->setupErrors($handle);

            $this->setHandlers($config);
            $this->setScope($config, $request->getPathInfo());
            $this->loadLang($config);

            return $config;
        });
    }

    protected function getEnvironment(Request $request, $environments)
    {
        $host = $this->removeWWW($request->getHost());
        foreach ($environments as $key => $environment) {
            if ($this->removeWWW($environment['host']) == $host) {
                return $key;
            }
        }
        return false;
        //throw new \Exception("No hay ningún environment definido para este host: $host");
    }

    protected function removeWWW($host)
    {
        return str_replace('www.', '', $host);
    }

    protected function setScope($config, $request_path)
    {
        $scopes = $config->get('environment.scopes') ?: $config->get('scopes');

        if (!empty($scopes)) {
            foreach ($scopes as $scope => $prefix) {
                if ($prefix && substr($request_path, 0, strlen($prefix)) == $prefix) {
                    $config->set('environment.scope', $scope);
                    $config->set('scope', $scope);
                    return $scope;
                }
            }
        }

        return $config->get('environment.scope') ?: $config->get('scope');
    }

    protected function setHandlers($config)
    {
        $handlers = [];
        $directory = new \RecursiveDirectoryIterator($config->get('paths.handlers'));
        $flattened = new \RecursiveIteratorIterator($directory);
        foreach (new \RegexIterator($flattened, '@.*/Handler/(.*)Handler.php@',
            \RecursiveRegexIterator::GET_MATCH) as $file) {
            $handlers[strtolower($file[1])] = str_replace('/', "\\", 'App/Handler/' . $file[1] . 'Handler');
        }
        $config->set('handlers', $handlers);
    }

    protected function loadLang($config)
    {
        $scope = $config->get('environment.scope');
        $lang = $config->get('environment.lang') ?: $config->get('lang');
        $paths = $config->get('paths');
        date_default_timezone_set("Europe/Madrid");

        $file = $paths['views'] . '/' . $scope . '/langs/' . $lang . '.po';
        if (file_exists($file)) {
            $fileHandler = new FileHandler($file);
            $poParser = new PoParser($fileHandler);
            $GLOBALS['traducciones'] = $poParser->parse();
        }
    }

    protected function getLang($request_path)
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

}
