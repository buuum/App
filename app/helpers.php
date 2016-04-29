<?php

if (!function_exists('_e')) {

    /**
     *
     * Return translate text
     *
     * @param $text
     * @return string
     */
    function _e($text)
    {
        $text = (!empty($GLOBALS['traducciones'][$text]) && !empty($GLOBALS['traducciones'][$text]['msgstr'][0])) ? $GLOBALS['traducciones'][$text]['msgstr'][0] : $text;
        return stripslashes($text);
    }
}

if (!function_exists('dd')) {

    /**
     * return var_dump parameters passed and die execution page.
     */
    function dd()
    {
        ini_set('xdebug.var_display_max_depth', -1);
        ini_set('xdebug.var_display_max_children', -1);
        ini_set('xdebug.var_display_max_data', -1);
        array_map(function ($x) {
            var_dump($x);
        }, func_get_args());
        die;
    }
}
