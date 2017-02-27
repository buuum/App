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

    public function setAppends($appends)
    {
        $collections = [];
        foreach ($this->collection as $item) {
            $collections[] = $item->setAppends($appends);
        }

        $this->collection = new Collection($collections);
    }

    public function makeHidden($hiddens)
    {
        $this->collection->makeHidden($hiddens);
    }
}