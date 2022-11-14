<?php

namespace App\Http\Controllers;

use App\Models\Catagories;
use App\Models\Languages;
use App\Models\attachments;
use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;
use App\Traits\LanguagesTrait;
use App\Traits\TranslateAutoCatTrait;
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
        $idLang =  $this->Languages();

        $firstCheck = Catagories::first();

        if($firstCheck){

            $LatestLangId =  Catagories::orderBy('lang_id', 'desc')->first()->lang_id;

            
            if($LatestLangId != $idLang){

                $collection = $idLang - $LatestLangId;


                $lanItem = Languages::get('id');

                $arrLang = [];

                foreach ($lanItem as $key => $value) {

                    $arrLang[] = $value->id;
                }


                $takeLanguageId =  array_splice($arrLang , - $collection);


                $takeLangSlug = [];

                foreach( $takeLanguageId as $key) {
                
                    $takeLangSlug[] = Languages::where('id' , $key)->get(['Language_name' , 'id']);
                }

                $filterSlug = [];

                $idLanguage = [];

                foreach( $takeLangSlug as $key) {

                    foreach ($key as $newKey) {

                        $filterSlug[] =  $newKey->Language_name;

                        $idLanguage[] =  $newKey->id;
                    }
                }

                $catagoriesMustTranslateAuto = Catagories::all();

                $checkId = [];

                $index = 0;


                foreach( $catagoriesMustTranslateAuto as $key){

                    $checkId[$index] = $key->translation_id;

                    $index++;
                }

                $checkIdUnique = array_unique($checkId);

                $values = array_values($checkIdUnique);

                foreach($checkIdUnique as $key){

                    $allName[] = Catagories::where('translation_id' ,  $key)->first()->name_cat;
                }
         
                for ($i=0; $i < count($filterSlug); $i++) { 

                    for ($x=0; $x < count($checkIdUnique); $x++) { 

                        $tr = new GoogleTranslate($filterSlug[$i]);

                        Catagories::create([
                            'name_cat'              => $tr->translate($allName[$x]),
                            'lang_id'               => $idLanguage[$i],
                            'translation_id'        => $values[$x],
                        ]);
                    }
                }
            }
        }

        $GetDataByLang = Languages::where('Language_name' , LaravelLocalization::getCurrentLocale())->first()->id;

        $Catagories =  Catagories::where('lang_id', $GetDataByLang)->get();



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

            $languagesData =  Languages::get(['id' , 'Language_name']);

                foreach($languagesData as $key){

                    $tr = new GoogleTranslate($key->Language_name); // Translates into English

                    Catagories::create([
                        'name_cat'            => $tr->translate($request->name_cat),
                        'lang_id'             => $key->id,
                        'translation_id'      => $request->translation_id,
                    ]);
                }

            $LatestImages =  Catagories::latest()->first()->id;

            $this->UploadFile($request->file, 'images/Catagories',$LatestImages);
            
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
    //   return  Catagories::find($id)->get();

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
