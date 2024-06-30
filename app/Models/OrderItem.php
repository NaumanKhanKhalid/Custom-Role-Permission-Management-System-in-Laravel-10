<?php

namespace App\Models;

use App\Models\Order;
use App\Models\PackageItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'item_id', 'item_type', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function item()
    {
        return $this->belongsTo(PackageItem::class, 'item_id');
    }
}
