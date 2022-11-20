<?php

namespace App\Http\Controllers;


use App\Models\carts;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Traits\UploadFileTrait;
use App\Traits\LanguagesTrait;
use App\Traits\TranslateAutoTrait;

use LaravelLocalization;

class InvoiceItemsController extends Controller
{

    // Last Language
    use LanguagesTrait;

    // TranslateAuto ALL Application
    use TranslateAutoTrait;

    //upload File
    use UploadFileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $items =  carts::with(['cart' => function($q){
            $q->where('lang_id' , $this->GetIdLang());
        }])->get();

        return view('invoices.invoice_items' , compact('items'));
    }


    public function countItems(Request $request)
    {
        $Success = ['Success' => 'Your Product is Added On Your Cart'];

        $CartItem  = carts::where("cart_id" , $request->cart_id )->where("user_id", Auth::user()->id)->first();

        $CartItem->update([
            'count' => $request->count
        ]);

        return  response()->json($Success , 200);
    }

    public function cart(Request $request)
     {
        $exist = ['exist' => 'This is Product is Exist On Your Cart'];
        $Success = ['Success' => 'Your Product is Added On Your Cart'];

        $findIsExist  = carts::where("cart_id" , $request->id )->where("user_id", Auth::user()->id)->first();

        if($findIsExist){
            return  response()->json($exist , 226);

        }else{
            carts::create([
                "cart_id" => $request->id,
                "user_id" => Auth::user()->id,
            ]);
    
            return  response()->json($Success , 201);
        }

    }
}
