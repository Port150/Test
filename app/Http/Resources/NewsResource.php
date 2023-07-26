<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
          'id'                                  =>$this->id,
          'title'                               =>$this->title,
          'description'                         =>$this->description,
          'text'                                =>$this->text,
          'img_url'                             =>$this->img_url,
          'publication_date'                    =>$this->publication_date,
        ];
    }

}
