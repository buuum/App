<?php
namespace Application\Controller;

use Application\Controller\Traits\HeaderTrait;
use Application\Controller\Traits\RequestTrait;
use Application\Controller\Traits\RouterTrait;
use Application\Controller\Traits\SessionTrait;
use Application\Controller\Traits\ViewTrait;
use Sepia\FileHandler;
use Sepia\PoParser;

abstract class AbstractController
{
    use ViewTrait;
    use HeaderTrait;
    use RequestTrait;
    use SessionTrait;
    use RouterTrait;

    protected $scope;

    private static $_instances = [];

    public function __construct()
    {
        $this->setInstance();
    }

    /**
     * @return self
     */
    public static function getInstance()
    {
        $class = get_called_class();
        return self::$_instances[$class];
    }

    public function setInstance()
    {
        $class = get_called_class();
        self::$_instances[$class] = $this;
    }

    public function render($view, array $data = array(), $layout = 'layout')
    {
        $data = array_merge($data, array('header' => $this->header->get()));
        return $this->view->render($view, $data, $layout);
    }

    protected function loadLang($lang)
    {
        $file = $this->view->getDir() . '/../langs/' . $lang . '.po';
        if (file_exists($file)) {
            $fileHandler = new FileHandler($file);
            $poParser = new PoParser($fileHandler);
            $GLOBALS['traducciones'] = $poParser->parse();
        }

    }
}
