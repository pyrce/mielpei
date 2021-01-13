<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommandeClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $produits = ProduitsResource::collection($this->produits);
        return [
            'id' => $this->id,
            "prix"=>$this->prix,
            "quantite"=>$this->quantite,
            "produit"=>$produits

        ];
    }
}
