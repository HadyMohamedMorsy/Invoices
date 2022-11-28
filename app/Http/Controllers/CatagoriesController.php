<?php

namespace App\Http\Controllers;

//Actions
use App\Http\Controllers\Actions\catagories\ActionCatagories;
use App\Http\Controllers\Actions\catagories\ActionsCatagoriesStore;
use App\Http\Controllers\Actions\catagories\ActionCatagoriesShow;
use App\Http\Controllers\Actions\catagories\ActionCatagoriesUpdate;
use App\Http\Controllers\Actions\catagories\ActionCatagoriesDestroy;
use App\Http\Controllers\Actions\catagories\ActionCatagoriesMulti;
use App\Http\Controllers\Actions\catagories\ActionCatagoriesMultiUpdate;
use App\Http\Controllers\Actions\catagories\ActionCatagoriesSearch;

// Models
use App\Models\Catagories;
use App\Http\Requests\Catagories\Multicatagory;
use App\Models\Languages;

//Requests
use App\Http\Requests\Catagories\StoreCatagoriesRequest;
use App\Http\Requests\Catagories\UpdateCatagories;
use App\Http\Requests\Catagories\MultiUpdate;

// Request Fields
use Illuminate\Http\Request;

// Traits
use App\Traits\UploadFileTrait;
use App\Traits\LanguagesTrait;
use App\Traits\TranslateAutoTrait;


//Google Translate Library
use Stichoza\GoogleTranslate\GoogleTranslate;


class CatagoriesController extends Controller
{

    // Last Language
    use LanguagesTrait;

    // TranslateAuto ALL Application
    use TranslateAutoTrait;

    //upload File
    use UploadFileTrait;



    public function index(ActionCatagories $GetCatagories)
    {
        // Translate Automatic When User Added Language More Like Ar , En , Fr
        $this->TranslateAutoCatTrait('Catagories');

        // GetCatagories Related Current Languages
        $Catagories =  $GetCatagories->GetCatagories();

        return view('category.catagories' , compact('Catagories'));
    }


    public function create()
    {
        return view('category.create');
    }

    public function store(StoreCatagoriesRequest $request , ActionsCatagoriesStore $SetCatagories)
    {
        if($request->file){
            
            // Store Catagories
            $SetCatagories->SetCatagories($request);


            return redirect('/catagories')->with("success","This catagories Is Added");
        }
    }


    public function show($id , ActionCatagoriesShow $showCategories)

    {
        //Show Catagories With Products Related 
        $GetCatagoriesRelatedProducts =  $showCategories->ShowCatagoriesRelatedProducts($id);

        // define Variable Empty Array To Get Products Only 
        $products = [];

        foreach ($GetCatagoriesRelatedProducts as $key) {

            // Get Products
            $products = $key->pro;
        }

        // Get Current Category Then I cached My Products Related This Category And Category
        $showCategory =  $showCategories->GetCatagories($id);

        return view('category.show' , compact(['showCategory' , 'products']));
    }


    public function edit($id)
    {
        $showCategory =  Catagories::where('translation_id' , $id)->where('lang_id' , $this->GetIdLang())->first();

        return view('category.edit' , compact('showCategory'));
    }

    public function update(UpdateCatagories $request , $id , ActionCatagoriesUpdate $Update){

        // Request Update With validation Update Single Current Category Related Current Languages 

        // I Have Problem Validation Unique Id I will Return Later 
        $Update->ActionCatagoriesUpdate($request , $id);

        return redirect('/catagories')->with("updated","This catagories Is updated");

    }


    public function destroy($id , ActionCatagoriesDestroy $DeleteCategory){

        // DeleteCategory All Languages With us 
        $DeleteCategory->DestroyCategory($id);

        return redirect('/catagories')->with("Deleted","This catagories Is Deleted");

        
    }

    public function multi(Multicatagory $request , ActionCatagoriesMulti $multi) {

        if($request->file){

            // Store Catagories DataBase Multi Dynamic Request 
            $multi->ActionCatagoriesMulti($request);
        
            return redirect('/catagories')->with("success","This catagories Is Added");
        }
    }

    public function multiUpdate(MultiUpdate $request , $id , ActionCatagoriesMultiUpdate $UpdateMulti){

        // Request Update With validation Update Single Current Category Related Current Languages 

        // I Have Problem Validation Unique Id I will Return Later 

        $UpdateMulti->UpdateManyCatagoriesLanguage($request , $id);

        return redirect('/catagories')->with("success","This catagories Is Added");
        
    }

    public function search(Request $request , ActionCatagoriesSearch $search){


        // Search About Catagories 
        $Catagories =  $search->search($request);

        return view('category.search' , compact('Catagories'));

    }
}
