<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attachments extends Model
{
    use HasFactory;

    protected $fillable = ['image_name' , 'attachmentable_type' , 'attachmentable_id' , 'type'];
    protected $hidden = ['attachmentable_type' , 'attachmentable_id' , 'type' , 'created_at' , 'updated_at' , 'id'];

    public function  attachmentable() {

        return $this->morphTo();
    }





}
