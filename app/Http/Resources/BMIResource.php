<?php

namespace App\Http\Resources;

use App\Services\BMIService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BMIResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'height' => $this->height,
            'weight' => $this->weight,
            'created_at' => $this->created_at,
            'created_at_formatted' => $this->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i:s'),
            'result' => $this->result,
            'classification' => $this->getBodyMassIndexClassification()
        ];
    }
}
