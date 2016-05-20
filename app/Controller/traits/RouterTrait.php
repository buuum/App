<?php
namespace Application\Controller\Traits;

use Buuum\Dispatcher;

trait RouterTrait
{
    /**
     * @var Dispatcher
     */
    protected $router;

    public function setRouter(Dispatcher $router)
    {
        $this->router = $router;
    }

}
