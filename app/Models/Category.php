<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    protected static function booted()
    {
        static::saving(function ($obj) {
            $obj->slug = str()->slug($obj->name_tm);
        });
    }

    public function product()
    {
        return $this->hasMany(Product::class)
            -> orderBy('id', 'desc');
    }

    public function getName()
    {
        if (app()->getLocale() == 'en') {
            return $this->name_en ?: $this->name_tm;
        } else {
            return $this->name_tm;
        }
    }


    public function getImage()
    {
        return $this->image ? Storage::url('c/' . $this->image) : asset('img/category.jpg');
    }
}
