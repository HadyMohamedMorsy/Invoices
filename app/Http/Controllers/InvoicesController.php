<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\carts;
use Illuminate\Http\Request;

use App\Traits\UploadFileTrait;
use App\Traits\LanguagesTrait;
use App\Traits\TranslateAutoTrait;

class InvoicesController extends Controller
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
     */
    public function index()
    {
    }
        


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $invoices =  invoices::where('id',$id)->where('type' , "cash")->orWhere('type' , "كاش")->first();
      $VarMultiID =  json_decode($invoices->product_id , true);
      $GetCarts = array();

      foreach($VarMultiID as  $id){
        $GetCarts[] = (int) $id;
      }
      return $GetCarts;
      
      // Get Items To Checkout   
      return view('invoices.invoice_total' , compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices)
    {
        //
    }

    public function installments()
    {
        $invoices =  invoices::where('type' , "installment")->orWhere('type' , "قسط")->get();
        return view('invoices.all_invoices-installments' , compact('invoices'));
    }

    public function cash()
    {
        $invoices =  invoices::where('type' , "cash")->orWhere('type' , "كاش")->get();
        return view('invoices.all_invoices-cash' , compact('invoices'));
    }
}

