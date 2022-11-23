<?php

namespace App\Http\Controllers;


use App\Models\carts;
use App\Models\types;
use App\Models\products;
use App\Models\invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Traits\UploadFileTrait;
use App\Traits\LanguagesTrait;
use App\Traits\TranslateAutoTrait;

use LaravelLocalization;

use function PHPUnit\Framework\isEmpty;

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
        
        $items =  carts::with(['cart' => function($q){

            $q->where('lang_id' , $this->GetIdLang());
            
        }])->get();

        return view('invoices.invoice_items' , compact('items' , 'TypePayment'));
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

        $getPayStatus = invoices::orderBy('id', 'desc')->first();

        $carts =  carts::where('invoice_NO', NULL)->get();

        
        if($getPayStatus){

            if($getPayStatus->status == "Not_Payment"){

                $Updated =  $getPayStatus->update([
                    'name_client'    => $request->name_client,
                    'phone'          => $request->number_phone,
                    'total_invoice'  => $request->Checkout,
                    'total'          => $request->Checkout,
                ]);

                if($carts){
                    foreach ($carts as $cart) {
                        $cart->update([
                            'invoice_NO' => $request->invoice_number
                        ]);
                    }
                }

                if($Updated){

                    if($request->Type_Payment == 'cash' || $request->Type_Payment == 'كاش' ) {

                        return redirect('/cashing')->with("updated","This Invoices Is updated");

                    }else{

                        return redirect('/installinstallments')->with("updated","This Invoices Is updated");
                    }
                }
            }
        }

        $Added = invoices::create([

            'number_invoice' => $request->invoice_number,
            'employee_id'    => Auth::user()->id,
            'name_client'    => $request->name_client,
            'phone'          => $request->number_phone,
            'type'           => $request->Type_Payment,
            'total_invoice'  => $request->Checkout,
            'total'          => $request->Checkout,

        ]);

        if($carts){

            foreach ($carts as $cart) {

                $cart->update([

                    'invoice_NO' => $request->invoice_number
                ]);
            } 
        }

        if($Added){

            if($request->Type_Payment == 'cash' || $request->Type_Payment == 'كاش' ) {

                return redirect('/cashing')->with("success","This Invoices Is Added");

            }else{

                return redirect('/installinstallments')->with("success","This Invoices Is Added");
            }
        }

    }

    public function DeleteItem(Request $request){

        $Success = ['Success' => 'Your Product is Deleted On Your Cart'];

        $findIsExist  = carts::where("cart_id" , $request->Cart_id )->where("user_id", Auth::user()->id)->first();

        $findIsExist->delete();

        return  response()->json($Success , 201);

    }
}
