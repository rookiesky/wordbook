<?php
namespace App\Transformers;


use Vinkla\Hashids\Facades\Hashids;

class ListTransformer extends Transformer
{
    public function transformer($item)
    {
        return [
            'hash' => Hashids::encode($item['id']),
            'title' => $item['title']
        ];
    }
}