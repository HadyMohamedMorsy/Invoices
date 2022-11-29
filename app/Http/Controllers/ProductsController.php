<?php

namespace App\Http\Controllers;

//Actions
use App\Http\Controllers\Actions\Products\ActionProducts;
use App\Http\Controllers\Actions\Products\ActionsProductsStore;
use App\Http\Controllers\Actions\Products\ActionProductsEdit;
use App\Http\Controllers\Actions\Products\ActionProductsUpdate;
use App\Http\Controllers\Actions\Products\ActionProductsDestroy;
use App\Http\Controllers\Actions\Products\ActionProductsMulti;
use App\Http\Controllers\Actions\Products\ActionProductsMultiUpdate;
use App\Http\Controllers\Actions\Products\ActionProductsSearch;
use App\Http\Controllers\Actions\Products\ActionFiltration;


// models
use App\Models\products;
use App\Models\Catagories;

//Requests
use App\Http\Requests\Products\StoreProductsRequest;
use App\Http\Requests\Products\UpdateRequest;

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

    

    public function index(ActionProducts $GetCatAndProduct)
    {
        // Translation Automatic When Add Language More AR-FR-EN
        $this->TranslateAutoCatTrait('products');

        // Get Products From data Base
        $products = $GetCatAndProduct->GetProducts();

        // Get Catagories From data Base To Put on Filter
        $Catagories =  $GetCatAndProduct->GetCatagories();

        return view('products.products' , compact(['Catagories' , 'products']));

    }

    public function create()
    {
        $GetCatagories = Catagories::where('lang_id' , $this->GetIdLang())->get();

        return view('products.create' , compact('GetCatagories'));
    }

    public function store(StoreProductsRequest $request , ActionsProductsStore $Store)
    {
        if($request->file){

        // store Products On data Base 
        $Store->SetProducts($request);

        return redirect('/products')->with("success","This Products Is Added");
        }   
    }
    public function show($id)
    {
        $showProduct =  products::where('translation_id' , $id)->where('lang_id' , $this->GetIdLang())->first();

        return view('products.show' , compact('showProduct'));
    }

    public function edit($id , ActionProducts $GetCategory , ActionProductsEdit $Edit)
    {
        // Get Related Product And Category Many to Many 
        $editProduct =  $Edit->GetProductRelatedCategory($id);

        // Get Category From Query Many To Many 
        $MySelectedCategory = $Edit->getCategory($id);
        
        // Get Category All To Set On Options Selected
        $Catagories =  $GetCategory->GetCatagories();

        return view('products.edit' , compact(['editProduct' , 'Catagories' , 'MySelectedCategory']));
    }

    public function update(UpdateRequest $request , $id , ActionProductsUpdate $updating)
    {
        // updating Single product And Image And Updating Product Related Catagories  
        $updating->ActionProductsUpdate($request , $id);

        return redirect('/products')->with("updated","This Products Is updated");
    }

    public function destroy($id , ActionProductsDestroy $destroyed)
    {
        // Deleted Product With  Catagories Related On Table Many To Many 
        $destroyed->DestroyProducts($id);

        return redirect('/products')->with("Deleted","This Products Is Deleted");
    }

    public function Filtration(Request $request, ActionFiltration $Filtration , ActionProducts $GetCategory){

        // When Click Filter It Will Be FIlter products Related Catagories Selected 
        $FinalFiltration =   $Filtration->GetFiltration($request);

        // Get Catagories From data Base To Put on Filter
        $Catagories =  $GetCategory->GetCatagories();

        return view('products.filtration' , compact(['FinalFiltration' , 'Catagories']));

    }

    public function productMulti(Request $request){

        return $request;

    }

}
