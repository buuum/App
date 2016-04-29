<?php

namespace Application\Helper;

class HelperTemplate
{
    public static function getUrl($name, $options)
    {

        if ($options) {
            $value = "\$this->urls->getUrlRequest('" . $name . "', $options)";
        } else {
            $value = "\$this->urls->getUrlRequest('" . $name . "', [])";
        }

        //$value = "'//'.Easyf\\Application\\Facades\\Config::get('host').'/'." . $value . ".'/'";
        return $value;
    }

    public static function langText($text, $params)
    {
        if ($params) {
            $value = "vsprintf(_e(\"$text\"), $params);";
        } else {
            $value = "_e(\"$text\")";
        }

        return $value;
    }

    public static function imgUrl()
    {
        return "'//'.\$this->config->getHost().'/assets/'.\$this->config->get('scope')";
    }

    public static function printVar($value)
    {
        return "<?=$value?>";
    }

}

