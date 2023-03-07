<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class)
            ->orderBy('id');
    };

    public function language()
    {
        switch ($this->language) {
            case 1:
                return 'eng';
            default:
                return 'tkm';
        }
    }

    public function updatePrice()
    {
        $totalPrice = 0;
        foreach ($this->orderProducts as $product) {
            $totalPrice += ($product->total_price * $product->quantity);
        }
        $this->total_price = round($totalPrice, 1);
        $this->update();
    }
}
