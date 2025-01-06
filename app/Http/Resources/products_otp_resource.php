<?php

namespace App\Http\Resources;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class products_otp_resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'product_info' => Products::where('name',$this->name)->get(),
          'validate code'=> $this->otpcode
        ];
    }
}
