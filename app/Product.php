<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'value',
        'quantity',
        'category_id',
    ];
}
