<?php

namespace App\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function media(): MorphMany
    {
       return $this->morphMany(Media::class, 'model');
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
