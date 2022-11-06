<?php

namespace App\Http\Controllers;

use App\Models\Catagories;
use App\Models\attachments;
use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;

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
        return view('catagory.catagories');
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
        'name'              => 'required|unique:catagories|max:50',
        'file'              => 'required|max:10000|mimes:pdf,png,jpg',
    ],[
        'name.required'     => 'name is required',
        'name.unique'       => 'This Name is exist before don\'t Try Set Different Category',
        'name.max'          => 'This Name maxim 50 character',
        'file.required'     => 'this file is require to upload',
        'file.max'          => 'this file maximum 10000kb',
        'file.mimes'        => 'this type is Strange'
    ]);

        if($request->file){
            
            Catagories::create([
                'name'          => $request->name,
                'lang_id'       => 1,
            ]);

            $cat_id = Catagories::latest()->first()->id;
            
            $this->UploadFile($request->file, 'images/catagories' , $cat_id);
            
            
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
