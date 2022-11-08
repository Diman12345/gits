<?php

namespace App\Http\Resources;

use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookResourceCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->author_id){
            $data_auth = Author::find($this->author_id);
        } else {
            $data_auth = "-";
        }

        if($this->publisher_id){
            $data_pub = Publisher::find($this->publisher_id);
        } else {
            $data_pub = "";
        }
        return [
            'title' => $this->title,
            'description' => $this->description,
            'author_id' => $this->author_id,
            'author_name' => $data_auth,
            'publisher_id' => $this->publisher_id,
            'publisher_name' => $data_pub
        ];
    }
}
