<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'category_id',
        'code',
        'name',
        'description',
        'image',
        'price',
        'hit',
        'new',
        'recommend',
        'count'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount($count = null) {
        if (!is_null($count)) {
            return $count * $this->price;
        }
    
        if (!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
    
        return $this->price;
    }

    public function getRouteKeyName(): string
    {
        return 'code';
    }

    public function isAvailable(){
        return $this->count > 0;
    }
    
    public function isHit(){
        return $this->hit === 1;
    }

    public function isNew(){
        return $this->new === 1;
    }
    
    public function isRecommend(){
        return $this->recommend === 1;
    }

    
    

}
