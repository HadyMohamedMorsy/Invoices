<?php

namespace App\Http\Controllers;

use App\Models\Catagories;
use App\Models\attachments;
use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;

use Stichoza\GoogleTranslate\GoogleTranslate;


class CatagoriesController extends Controller
{

    use UploadFileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $int = (int)__('requestLang.request_code');

        $Catagories =  Catagories::where('lang_id', $int)->get();

        return view('catagory.catagories' , compact('Catagories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catagory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    $validated = $request->validate([

        'name_cat'     => 'required|unique:catagories|max:50',
        'file'              => 'required|max:10000|mimes:pdf,png,jpg',
    ],[
        'name_cat.required'     => 'name is required',
        'name_cat.unique'       => 'This Name is exist before don\'t Try Set Different Category',
        'name_cat.max'          => 'This Name maxim 50 character',
        'file.required'     => 'this file is require to upload',
        'file.max'          => 'this file maximum 10000kb',
        'file.mimes'        => 'this type is Strange'
    ]);


        if($request->file){

            if($request->lang_id == "1"){

                $tr = new GoogleTranslate('ar'); // Translates into English

                Catagories::create([
                    'name_cat'     => $request->name_cat,
                    'lang_id'      => $request->lang_id,
                ]);
                Catagories::create([
                    'name_cat'     => $tr->translate($request->name_cat),
                    'lang_id'      => $request->lang_id + 1,
                ]);
                
            }else{

                $tr = new GoogleTranslate('en'); // Translates into English

                Catagories::create([
                    'name_cat'     => $request->name_cat,
                    'lang_id'      => $request->lang_id,
                ]);
                Catagories::create([
                    'name_cat'     => $tr->translate($request->name_cat),
                    'lang_id'      => $request->lang_id - 1,
                ]);
            } 


            return redirect('/catagories')->with("success","This catagories Is Added");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catagories  $catagories
     * @return \Illuminate\Http\Response
     */
    public function show(Catagories $catagories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catagories  $catagories
     * @return \Illuminate\Http\Response
     */
    public function edit(Catagories $catagories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catagories  $catagories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catagories $catagories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catagories  $catagories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catagories $catagories)
    {
        //
    }
}
