<?php
namespace Application\Controller\Traits;

use Symfony\Component\HttpFoundation\Session\Session;

trait SessionTrait
{
    /**
     * @var Session
     */
    protected $session;

    public function setSession(Session $session)
    {
        $this->session = $session;
    }

}
