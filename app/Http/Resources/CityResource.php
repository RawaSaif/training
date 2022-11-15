<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'name' => $this->name,
            'name_en' => $this->name_en,
            'status' => $this->status,
            'is_deleted' => $this->is_deleted,
            'country_id' => $this->country_id,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'country_id' => $this->country,
    
          
          ];
        //return parent::toArray($request);
    }
}