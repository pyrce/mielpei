<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProducteurResource extends JsonResource
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
            'nomProducteur' => $this->nomProducteur,
            'prenomProducteur' => $this->prenomProducteur,
            'adresse' => $this->adresse,
            'tel' => $this->tel,
        ];
    }
}
