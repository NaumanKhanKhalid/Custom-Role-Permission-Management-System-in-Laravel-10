<?php

namespace App\Models;

use App\Models\Package;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['package_id', 'name', 'price', 'status'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class); // Ensure this is correct
    }
}
