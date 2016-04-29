<?php
namespace Application\Controller\Traits;


use Symfony\Component\HttpFoundation\Request;

trait RequestTrait
{
    /**
     * @var Request
     */
    protected $request;

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

}
