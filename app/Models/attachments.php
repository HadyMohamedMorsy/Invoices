<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attachments extends Model
{
    use HasFactory;

    protected $fillable = ['image_name','product_id' , 'category_id' , 'user_id' , 'Invoice_id'];





}
