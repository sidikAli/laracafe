<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public static $wrap = 'order';

    public function toArray($request)
    {
        return [
            'id' => $this->order->id,
            'nama' => $this->order->nama,
            'no_meja' => $this->order->nama,
            'order' => [
                'food' => $this->food,
                'qty' => $this->qty,
                'keterangan' => $this->keterangan
            ] 
        ];
    }
}
