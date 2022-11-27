<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class permissions extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function Permissions(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
        );
    }

}
