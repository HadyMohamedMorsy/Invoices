<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    use HasFactory;

    protected $table = 'Invoices';
    protected $fillable = ['number_invoice' , 'status' , 'client_id' , 'type' , 'total_invoice' , 'total' ,'presenter' ,'years' ,'product_id', 'total_pay' , 'created_at' , 'updated_at'];

}
