<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Special_offerResource extends JsonResource
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
            'product_thambnail' => $this->product_thambnail,
            'product_name' => $this->product_name,
            'product_qty' => $this->product_qty,
            'selling_price' => $this->selling_price,
            'discount_price' => $this->discount_price,
            'product_size' => $this->product_size,
            'product_color' => $this->product_color,
            'product_descp' => $this->product_descp,
            'video_link' => $this->video_link,
            'unit' => $this->unit,

        ];
    }
}
