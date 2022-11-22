<?php

namespace App\Http\Controllers;


use App\Models\carts;
use App\Models\types;
use App\Models\case_payment;
use App\Models\products;
use App\Models\invoices;
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
        $TypePayment = types::where('lang_id' ,$this->GetIdLang())->get();
        $typeStatusPayment = case_payment::where('lang_id' ,$this->GetIdLang())->first();
        
        $items =  carts::with(['cart' => function($q){
            $q->where('lang_id' , $this->GetIdLang());
        }])->get();

        $Variations = array();

        foreach($items as $item){
            $Variations[] = $item->id;
        }

        return view('invoices.invoice_items' , compact('items' , 'TypePayment' , 'typeStatusPayment' , 'Variations'));
    }


    public function countItems(Request $request)
    {
        $Success = ['Success' => 'Your Product is Updated On Your Cart'];
        $Error = ['Error' => 'There is Wrong Try Again'];

        $CartItem  = carts::where("cart_id" , $request->cart_id )->where("user_id", Auth::user()->id)->first();

       $checkUpdate =  $CartItem->update([
            'count' => $request->count,
            'total' => $request->subtotal
        ]);
        if($checkUpdate){
            return  response()->json($Success , 200);
        }else{
            return  response()->json($Error , 404);
        }
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
                'total'   => $request->price
            ]);
    
            return  response()->json($Success , 201);
        }

     }

     public function ClearCart(){
        carts::truncate();
        return view('Home.index');
     }

     public function Checkout(Request $request){

       $variations = $request->variations;
       $arrayvariations = explode(',',$variations);

        invoices::create([
            'number_invoice' => $request->invoice_number,
            'status'         => $request->type_status,
            'client_id'      => Auth::user()->id,
            'type'           => $request->Type_Payment,
            'total_invoice'  => $request->Checkout,
            'total'          => $request->Checkout,
            'product_id'     => json_encode($arrayvariations)
        ]);

        return redirect('/invoiceItems')->with("success","This catagories Is Added");
        
     }

     public function DeleteItem(Request $request){

        $Success = ['Success' => 'Your Product is Deleted On Your Cart'];

        $findIsExist  = carts::where("cart_id" , $request->Cart_id )->where("user_id", Auth::user()->id)->first();

        $findIsExist->delete();

        return  response()->json($Success , 201);

     }
}
