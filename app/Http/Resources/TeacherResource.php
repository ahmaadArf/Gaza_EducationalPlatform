<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'email'=>$this->email,
            'الاسم بالعربي'=>$this->getTranslation('name', 'ar'),
            'name_en'=>$this->getTranslation('name', 'en'),
            'specialization'=>new SpecializationResource($this->specializations),
            'gender'=>new GenderResource($this->genders) ,
            'joining_Date'=>$this->joining_Date,
            'address'=>$this->address,

        ];
    }
}
