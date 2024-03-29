<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'quantity' =>$this->quantity,
            'productId' => $this->product->id,
            'productName' => $this->product->name,
            'productPrice' => $this->product->price,
            'productImage' => $this->product->image,

            
        ];
        
    }
}
