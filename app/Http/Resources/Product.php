<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'category_id'   => (int)$this->category_id,
            'product_name'  => $this->product_name,
            'note'          => $this->note,
            'price'         => (double)$this->price,
        ];
    }
}
