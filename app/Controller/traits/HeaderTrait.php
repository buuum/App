<?php
namespace Application\Controller\Traits;

use Buuum\Template\Header;

trait HeaderTrait
{
    /**
     * @var Header
     */
    protected $header;

    public function setHeader(Header $header)
    {
        $this->header = $header;
    }

}
