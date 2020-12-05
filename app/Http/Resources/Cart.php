<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cart extends JsonResource
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
            'product_id'    => (int)$this->product_id,
            'product_name'  => $this->product->product_name,
            'price'         => (double)$this->product->price,
            'qty'           => $this->qty,
            'amount'        => (double)$this->product->price * $this->qty,
            'created_at'    => $this->created_at->diffForHumans(),
        ];
    }
}
