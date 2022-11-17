<?php

namespace App\Http\Controllers;


use App\Models\item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $exist = ['exist' => 'This is Product is Exist On Your Cart'];
        // $Success = ['Success' => 'Your Product is Added On Your Cart'];
        // $findIsExist  = item::where("item_id" , $request->id)->first();

        item::create([
            "item_id" => $request->id,
            "user_id " => "1",
        ]);

        return  response()->json($request->all());
    }
}
