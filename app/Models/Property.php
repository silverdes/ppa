<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'bedrooms',
        'bathrooms',
        'price',
        'address',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value){
        return now()->parse($value)->timezone(config('app.timezone'))->diffForHumans();
    }

    public function getUpdatedAtAttribute($value){
        return now()->parse($value)->timezone(config('app.timezone'))->diffForHumans();
    }

    public function getPriceAttribute($price)
    {
        return number_format($this->attributes['price'], 2);
    }
}
