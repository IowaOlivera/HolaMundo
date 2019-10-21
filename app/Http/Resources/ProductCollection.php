<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'products',
                'id' => $this->id,
            ],
            'attributes' => [
                'name' => $this->name,
                'price'=> $this->price,
            ],
        ];
    }
}
//$this->collection
