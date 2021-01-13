<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProduitsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $producteurs = new ProducteurResource($this->producteurs);
        return [
            'id' => $this->id,
            'nomProduit' => $this->horaire,
            'prix' => $this->prix,
            'quantite' => $this->quantite,
            'producteurs' => $producteurs
        ];
    }
}
