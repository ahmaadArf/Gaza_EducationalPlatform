<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpecializationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'الاسم بالعربي'=>$this->getTranslation('name', 'ar'),
            'name_en'=>$this->getTranslation('name', 'en'),

        ];
    }
}
