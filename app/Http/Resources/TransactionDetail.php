<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDetail extends JsonResource
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
            'production_id' => $this->product_id,
            'product_name'  => $this->product_name,
            'price'         => (double)$this->price,
            'qty'           => (int)$this->qty,
            'amount'        => (double)$this->qty * $this->price,
        ];
    }
}
