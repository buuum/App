<?php
namespace Application\Controller\Traits;

use Buuum\Template\View;

trait ViewTrait
{
    /**
     * @var View
     */
    protected $view;

    public function setView(View $view)
    {
        $this->view = $view;
    }

}
