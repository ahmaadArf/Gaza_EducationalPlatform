<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\GradeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name_ar'=>$this->getTranslation('name', 'ar'),
            'name_en'=>$this->getTranslation('name', 'en'),
            'Grade'=>new GradeResource($this->Grades),
        ];
    }
}
