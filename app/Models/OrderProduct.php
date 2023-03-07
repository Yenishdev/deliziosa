<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    const UPDATED_AT = null;


    public function order()
    {
        return $this->belongsTo(Order::class)
            ->withTrashed();
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function isDiscount()
    {
        if ($this->discount_percent > 0) {
            return true;
        } else {
            return false;
        }
    }



    public function updatePrice()
    {
        $totalPrice = $this->quantity * $this->price * (1 - $this->discount_percent / 100);
        $this->total_price = round($totalPrice, 1);
        $this->update();
    }

}
