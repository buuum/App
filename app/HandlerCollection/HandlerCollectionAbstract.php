<?php

namespace App\HandlerCollection;

use Illuminate\Database\Eloquent\Collection;

abstract class HandlerCollectionAbstract implements \JsonSerializable
{
    /**
     * @var Collection
     */
    protected $collection;
    protected $handlercollection;
    protected $handlerclass;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
        foreach ($collection as $item) {
            $this->handlercollection[] = new $this->handlerclass($item);
        }
    }

    public function toArray()
    {
        $array = [];
        foreach ($this->collection as $item) {
            $array[] = $item->toArray();
        }

        return $array;
    }

    public function jsonSerialize()
    {
        return $this->collection->toArray();
    }
}