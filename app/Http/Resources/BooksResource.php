<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Author;

class BooksResource extends JsonResource
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
            'id'=> (string)$this->id,
            'type'=>'Books',
            'attributes'=>[
                'name'=>$this->name,
                'authors'=>$this->authors,
                'description'=>$this->description,
                'publication_year'=>$this->publication_year,
                'created_at'=>$this->created_at,
                'updated_at'=>$this->updated_at,
            ]
            ];
    }
}
