<?php

namespace App\Http\Controllers;

// models
use App\Models\products;
use App\Models\Catagories;
use App\Models\Languages;


use Illuminate\Http\Request;


// Traits
use App\Traits\UploadFileTrait;
use App\Traits\LanguagesTrait;
use App\Traits\TranslateAutoTrait;

// Google Translate
use Stichoza\GoogleTranslate\GoogleTranslate;


class ProductsController extends Controller
{
    // Last Language
    use LanguagesTrait;

    // TranslateAuto ALL Application
    use TranslateAutoTrait;

    //upload File
    use UploadFileTrait;

    

    public function index()
    {
        $this->TranslateAutoCatTrait('products');

        $catagoriesProduct =  Catagories::with(['pro' => function($q){
            $q->where('lang_id' , $this->GetIdLang());
        }])->where('lang_id' , $this->GetIdLang() )->get();

        $products = products::where('lang_id' , $this->GetIdLang())->paginate(6);

        return view('products.products' , compact(['catagoriesProduct' , 'products']));
    }


    public function create()
    {

        $GetCatagories = Catagories::where('lang_id' , $this->GetIdLang())->get();

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

        $validated = $request->validate([
            $this->GetValidInputLang('name_pro')                 =>   'required|unique:products,name_product|max:50',
            $this->GetValidInputLang('des_pro')                  =>   'required',
            'number_pro'                                         =>   'required',
            'file'                                               =>   'required|max:10000|mimes:pdf,png,jpg',
        ]);

        if($request->file){

            
            $name_image = $this->GetFile($request->file);
            
            foreach($this->LanguagesCount() as $key){
                
                $tr = new GoogleTranslate($key->Language_name); // Translates into English

                    products::create([
                        'name_product'        => $tr->translate($request[$this->GetValidInputLang('name_pro')]),
                        'description'         => $tr->translate($request[$this->GetValidInputLang('des_pro')]),
                        'price'               => $request['number_pro'],
                        'lang_id'             => $key->id,
                        'image_name'          => $name_image,
                        'translation_id'      => $request->translation_id,
                    ]);
                    
                }

            $request->file->move('images/products' , $name_image);
            
            $latest =   products::orderBy('id', 'desc')->first()->translation_id;

            $product =  products::where('translation_id' , $latest )->where('lang_id' , $this->GetIdLang())->first();

            $product->category()->attach($request->product_category);

            return redirect('/products')->with("success","This Products Is Added");

        }   
    }
    public function show($id)
    {
        $showProduct =  products::where('translation_id' , $id)->where('lang_id' , $this->GetIdLang())->first();

        return view('products.show' , compact('showProduct'));
    }

    public function edit(products $products)
    {
        //
    }

    public function update(Request $request, products $products)
    {
        //
    }

    public function destroy(products $products)
    {
        //
    }

}
