<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBasicInformation extends Model
{
    use HasFactory;
    protected $table = 'user_basic_information';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'dob',
        'address',
        'phone',
        'profile_picture',
    ];

    protected function DOB(): Attribute
    {
        return new Attribute(
            set: fn ($value) => date('Y-m-d', strtotime($value)),
            get: fn ($value) => date('F d, Y', strToTime($value)),
        );
    }
    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


}
