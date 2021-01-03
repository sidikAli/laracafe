<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrderDetailResource;
use App\Order_detail;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'nama' => $this->nama,
            'no_meja' => $this->no_meja,
            'pesanan' => OrderDetailResource::collection(Order_detail::where('order_id', $this->id)->get())
        ];
    }
}
