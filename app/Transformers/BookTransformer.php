<?php
namespace App\Transformers;

class BookTransformer extends Transformer
{
    public function transformer($item)
    {
        return [
            'title' => $item['title'],
            'content' => $item['content']
        ];
    }

}