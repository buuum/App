<?php
namespace Application\Controller;

use Application\Controller\Traits\HeaderTrait;
use Application\Controller\Traits\RequestTrait;
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

    protected $scope;

    public function render($view, array $data = array(), $layout = 'layout')
    {
        $this->header->setScope($this->scope);
        return $this->view->render($this->scope, $view, $data, $layout, $this->header->get());
    }

    protected function loadLang($lang)
    {
        $file = __DIR__ . '/../Views/' . $this->scope . '/langs/' . $lang . '.po';
        if (file_exists($file)) {
            $fileHandler = new FileHandler($file);
            $poParser = new PoParser($fileHandler);
            $GLOBALS['traducciones'] = $poParser->parse();
        }

    }
}
