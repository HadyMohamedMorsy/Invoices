<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class types extends Model
{
    use HasFactory;
    protected $table = 'types_payment';
    protected $guarded = [];
    protected $hidden = ['created_at','updated_at'];
}
