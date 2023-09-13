<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
    	
    	$blog = $this;
    	
		$is_liked = false;
		if(!empty($blog->likes)){
			foreach ($blog->likes as $key => $like) {
			    if($like->user_id == $request->user()->id){
			    	$is_liked = true;
			    }
			}
		}
		$temp = array(
			"id" => $blog->id,
            "title"=> $blog->title,
            "code"=>$blog->code,
            "description"=> $blog->description,
            "image"=> $blog->image,
            "price"=> $blog->price,
            "sub_category_id"=> $blog->sub_category_id,
            "shipping_days"=> $blog->shipping_days,
            "pick_up"=>$blog->pick_up,
            "last_minute_shop"=>$blog->last_minute_shop,
            "is_liked" => $is_liked,
            "is_in_cart"=>0,
            "created_at"=> $blog->created_at,
            "updated_at"=> $blog->updated_at,
		);
		return $temp;
        
    }
}
