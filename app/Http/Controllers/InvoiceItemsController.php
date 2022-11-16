<?php

namespace App\Http\Controllers;

use App\Models\invoice_items;
use Illuminate\Http\Request;

class InvoiceItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
        return view('invoices.invoice_items');

    }


    public function store(Request $request)
    {
        return json_encode($request , true);
    }

    public function cart(Request $request)
    {
        return response()->json(['success' => 'Todo Added'],200);
    }

    
}
