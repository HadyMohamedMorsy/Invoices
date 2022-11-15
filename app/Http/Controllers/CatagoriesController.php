<?php

namespace App\Http\Controllers;

use App\Models\Catagories;
use App\Models\Languages;
use App\Models\attachments;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;
use App\Traits\LanguagesTrait;
use App\Traits\TranslateAutoCatTrait;
use JetBrains\PhpStorm\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;

use LaravelLocalization;


class CatagoriesController extends Controller
{

    use LanguagesTrait;
    use TranslateAutoCatTrait;
    use UploadFileTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // $idLang =  $this->Languages();

        // $firstCheck = Catagories::first();

        // if($firstCheck){

        //     $LatestLangId =  Catagories::orderBy('lang_id', 'desc')->first()->lang_id;

            
        //     if($LatestLangId != $idLang){

        //         $collection = $idLang - $LatestLangId;


        //         $lanItem = Languages::get('id');

        //         $arrLang = [];

        //         foreach ($lanItem as $key => $value) {

        //             $arrLang[] = $value->id;
        //         }


        //         $takeLanguageId =  array_splice($arrLang , - $collection);


        //         $takeLangSlug = [];

        //         foreach( $takeLanguageId as $key) {
                
        //             $takeLangSlug[] = Languages::where('id' , $key)->get(['Language_name' , 'id']);
        //         }

        //         $filterSlug = [];

        //         $idLanguage = [];

        //         foreach( $takeLangSlug as $key) {

        //             foreach ($key as $newKey) {

        //                 $filterSlug[] =  $newKey->Language_name;

        //                 $idLanguage[] =  $newKey->id;
        //             }
        //         }

        //         $catagoriesMustTranslateAuto = Catagories::all();

        //         $checkId = [];

        //         $index = 0;


        //         foreach( $catagoriesMustTranslateAuto as $key){

        //             $checkId[$index] = $key->translation_id;

        //             $index++;
        //         }

        //         $checkIdUnique = array_unique($checkId);

        //         $values = array_values($checkIdUnique);

        //         foreach($checkIdUnique as $key){

        //             $allName[] = Catagories::where('translation_id' ,  $key)->first()->name_cat;

        //             $allImages[] = Catagories::where('translation_id' ,  $key)->first()->image_name;
        //         }
         
        //         for ($i=0; $i < count($filterSlug); $i++) { 

        //             for ($x=0; $x < count($checkIdUnique); $x++) { 

        //                 $tr = new GoogleTranslate($filterSlug[$i]);

        //                 Catagories::create([
        //                     'name_cat'              => $tr->translate($allName[$x]),
        //                     'lang_id'               => $idLanguage[$i],
        //                     'image_name'            => $allImages[$x],
        //                     'translation_id'        => $values[$x],
        //                 ]);
        //             }
        //         }
        //     }
        // }

        $this->TranslateAutoCatTrait();

        $GetDataByLang = Languages::where('Language_name' , LaravelLocalization::getCurrentLocale())->first()->id;

        $Catagories =  Catagories::where('lang_id', $GetDataByLang)->get();


        return view('category.catagories' , compact('Catagories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validFiled = 'name_cat_'.LaravelLocalization::getCurrentLocale();

        $validated = $request->validate([

            $validFiled         =>   'required|unique:catagories,name_cat|max:50',
            'file'              => 'required|max:10000|mimes:pdf,png,jpg',
        ]);

        if($request->file){

            $languagesData =  Languages::get(['id' , 'Language_name']);


            $requestFile = $request->file;
            // Take Extension 
            
            $file_extension = $requestFile->getClientOriginalExtension();

            $file_name = time().'.'.$file_extension;
            
            // Upload Your File On The Server
            $requestFile->move('images/Catagories', $file_name);

                foreach($languagesData as $key){

                    $tr = new GoogleTranslate($key->Language_name); // Translates into English

                    Catagories::create([
                        'name_cat'            => $tr->translate($request[$validFiled]),
                        'lang_id'             => $key->id,
                        'image_name'          => $file_name,
                        'translation_id'      => $request->translation_id,
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
    public function show($id)
    {
        $language_id = Languages::where('Language_name' , LaravelLocalization::getCurrentLocale())->first()->id;

        $showCategory =  Catagories::where('translation_id' , $id)->where('lang_id' , $language_id)->first();

        return view('category.show' , compact('showCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catagories  $catagories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $language_id = Languages::where('Language_name' , LaravelLocalization::getCurrentLocale())->first()->id;

        $showCategory =  Catagories::where('translation_id' , $id)->where('lang_id' , $language_id)->first();

        return view('category.edit' , compact('showCategory'));

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

    public function multi(Request $request) 
    {
        if($request->file){

        $languagesData =  Languages::get(['id' , 'Language_name']);

        foreach($languagesData as $key){

            $validFiled = 'name_cat_'.$key->Language_name;

            $validated = $request->validate([

                $validFiled         =>   'required|unique:catagories,name_cat|max:50',
                'file'              => 'required|max:10000|mimes:pdf,png,jpg',
            ]);
        }

            $requestFile = $request->file;
            // Take Extension 
            
            $file_extension = $requestFile->getClientOriginalExtension();

            $file_name = time().'.'.$file_extension;
            
            // Upload Your File On The Server
            $requestFile->move('images/Catagories', $file_name);

                foreach($languagesData as $key){

                    $RequestFiled = 'name_cat_'.$key->Language_name;

                    Catagories::create([
                        'name_cat'            => $request[$RequestFiled],
                        'lang_id'             => $key->id,
                        'image_name'          => $file_name,
                        'translation_id'      => $request->translation_id,
                    ]);
                }

                return redirect('/catagories')->with("success","This catagories Is Added");
        }
    }

    public function search(Request $request){

        $query = $request->search;
        
        $Lang = $request->Lang;

       $LangId =  Languages::where('Language_name' , $Lang)->first();

       $Catagories =  Catagories::where('name_cat' , 'LIKE' , '%'.$request->search.'%')->where('lang_id' ,  $LangId->id)->get();

      return view('category.search' , compact('Catagories'));

    }
}
