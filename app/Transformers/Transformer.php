<?php
namespace App\Transformers;


abstract class Transformer
{
    public function transformCollection($items)
    {
        return array_map([$this,'transformer'],$items);
    }

    public abstract function transformer($item);
}