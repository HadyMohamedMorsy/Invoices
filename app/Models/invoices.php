<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    use HasFactory;

    protected $table = 'Invoices';
    protected $fillable = ['number_invoice' , 'status' , 'employee_id' , 'name_client', 'phone', 'type' , 'total_invoice' , 'total' ,'presenter' ,'years' , 'total_pay' , 'created_at' , 'updated_at'];

}
