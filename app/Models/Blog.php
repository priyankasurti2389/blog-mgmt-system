<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Blog extends Model
{
    use HasFactory;

     protected $fillable = [
        'title',
        'code',
        'image',
        'price',
        'sub_category_id',
        'description',
        'shipping_days',
        'pick_up',
        'last_minute_shop',
        'is_liked',
        'is_in_cart',
        'is_active',
    ];

    public function likes()
    {
        return $this->morphMany(BlogLikes::class, 'likeable');
    }

}
