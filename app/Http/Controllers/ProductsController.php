<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\Catagories;
use App\Models\Languages;
use Illuminate\Http\Request;

use App\Traits\LanguagesTrait;
use App\Traits\TranslateAutoCatTrait;

use Stichoza\GoogleTranslate\GoogleTranslate;
use LaravelLocalization;

class ProductsController extends Controller
{
    
    use LanguagesTrait;
    use TranslateAutoCatTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->TranslateAutoCatTrait('products');

        $catagoriesProduct =  Catagories::with(['pro' => function($q){
            $q->where('lang_id' , $this->GetCurrentId());
        }])->where('lang_id' , $this->GetCurrentId() )->get();

        $products = products::where('lang_id' , $this->GetCurrentId())->paginate(6);

        return view('products.products' , compact(['catagoriesProduct' , 'products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $CurrentLanguage = Languages::where('Language_name' , LaravelLocalization::getCurrentLocale())->first()->id;

        $GetCatagories = Catagories::where('lang_id' , $CurrentLanguage)->get();

        return view('products.create' , compact('GetCatagories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validFiled = 'name_pro_'.LaravelLocalization::getCurrentLocale();

        $desc = 'des_pro_'.LaravelLocalization::getCurrentLocale();
        
        $validated = $request->validate([

            $validFiled         =>   'required|unique:products,name_product|max:50',
            $desc               =>   'required',
            'number_pro'        =>   'required',
            'file'              =>   'required|max:10000|mimes:pdf,png,jpg',
        ]);

        if($request->file){

            $CurrentLanguage = Languages::where('Language_name' , LaravelLocalization::getCurrentLocale())->first()->id;

            $languagesData =  Languages::get(['id' , 'Language_name']);
            
            // Uploaded The Image On The system 
            $file_extension = $request->file->getClientOriginalExtension();

            $file_name = time().'.'.$file_extension;
            
            $request->file->move('images/products' , $file_name);

                foreach($languagesData as $key){

                    $tr = new GoogleTranslate($key->Language_name); // Translates into English

                    products::create([
                        'name_product'        => $tr->translate($request[$validFiled]),
                        'description'         => $tr->translate($request[$desc]),
                        'price'               => $request['number_pro'],
                        'lang_id'             => $key->id,
                        'image_name'          => $file_name,
                        'translation_id'      => $request->translation_id,
                    ]);

                }

            $latest = products::orderBy('id', 'desc')->first()->translation_id;

            $product =  products::where('translation_id' , $latest )->where('lang_id' , $this->GetCurrentId())->first();

            $product->category()->attach($request->product_category);

            return redirect('/products')->with("success","This Products Is Added");

        }   
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $showProduct =  products::where('translation_id' , $id)->where('lang_id' , $this->GetCurrentId())->first();

        return view('products.show' , compact('showProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(products $products)
    {
        //
    }

    protected function GetCurrentId(){
        
        return  Languages::where('Language_name' , LaravelLocalization::getCurrentLocale())->first()->id;
    }
}
