<?php

namespace App\Http\Controllers;

use App\Models\Catagories;
use App\Models\products;
use App\Models\Languages;

use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;
use App\Traits\LanguagesTrait;
use App\Traits\TranslateAutoTrait;

use JetBrains\PhpStorm\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;


use LaravelLocalization;


class CatagoriesController extends Controller
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

        $this->TranslateAutoCatTrait('Catagories');

        $Catagories =  Catagories::where('lang_id', $this->GetIdLang())->paginate(6);

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
        
        $validated = $request->validate([
            $this->GetValidInputLang('name_cat')  =>   'required|unique:catagories,name_cat|max:50',
            'file'                                =>   'required|max:10000|mimes:pdf,png,jpg',
        ]);

        if($request->file){
    
            $name_image = $this->GetFile($request->file);

            foreach($this->LanguagesCount() as $key){
                
                $tr = new GoogleTranslate($key->Language_name); // Translates into English
                
                Catagories::create([
                    'name_cat'            => $tr->translate($request[$this->GetValidInputLang('name_cat')]),
                    'lang_id'             => $key->id,
                    'image_name'          => $name_image,
                    'translation_id'      => $request->translation_id,
                ]);
                
            }

            $this->UploadFile($request->file , 'images/Catagories' , $name_image);

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
        $catagoriesProduct =  Catagories::with(['pro' => function($q){
            $q->where('lang_id' , $this->GetIdLang());
        }])->where('lang_id' , $this->GetIdLang() )->get();

        $count = [];

        foreach ($catagoriesProduct as $key) {

            $counts = $key->pro;
        }

        $showCategory =  Catagories::where('translation_id' , $id)->where('lang_id' , $this->GetIdLang())->first();

        return view('category.show' , compact(['showCategory' , 'counts']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catagories  $catagories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $showCategory =  Catagories::where('translation_id' , $id)->where('lang_id' , $this->GetIdLang())->first();

        return view('category.edit' , compact('showCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catagories  $catagories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id){


        $showCategory =  Catagories::where('translation_id' , $id)->where('lang_id' , $this->GetIdLang());

        $TakeImage =  $showCategory->first()->image_name;


        $file_path = public_path().'/images/Catagories/'.$TakeImage;


        // Uploaded The Image On The system 
        $name_image = $this->GetFile($request->file);


        if($file_path) {

            unlink($file_path);
        }


       $oldImages =  Catagories::where('translation_id' , $id)->get();

        foreach ($oldImages as $img) {

            Catagories::where('translation_id' , $img->translation_id)->where('lang_id' , $img->lang_id)
            ->update([
                'image_name' => $name_image
            ]);
        }

        $showCategory->update([
            'name_cat'      => $request[$this->GetValidInputLang('name_cat')],
            'image_name'    => $name_image, 
        ]);


        $this->UploadFile($request->file , 'images/Catagories' , $name_image);

        return redirect('/catagories')->with("updated","This catagories Is updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catagories  $catagories
     * @return \Illuminate\Http\Response
     */
    public function destroy($translation_id){

        $showCategory =  Catagories::where('translation_id' , $translation_id);

        $TakeImage =  $showCategory->first()->image_name;

        $file_path = public_path().'/images/Catagories/'.$TakeImage;

        if($file_path) {

            unlink($file_path); //delete from storage
        }

        $GetCatagories =  Catagories::where('translation_id' , $translation_id)->get();

        foreach ($GetCatagories as $category) {
            
            $category->delete();
        }

        return redirect('/catagories')->with("Deleted","This catagories Is Deleted");

        
    }

    public function multi(Request $request) {
        if($request->file){


        foreach($this->LanguagesCount() as $key){

            $validFiled = 'name_cat_'.$key->Language_name;

            $validated = $request->validate([

                $validFiled         =>   'required|unique:catagories,name_cat|max:50',
                'file'              => 'required|max:10000|mimes:pdf,png,jpg',
            ]);
        }

        // Uploaded The Image On The system 
            $name_image = $this->GetFile($request->file);

            
            foreach($this->LanguagesCount() as $key){
                
                $RequestFiledLang = 'name_cat_'.$key->Language_name;
                
                Catagories::create([
                    'name_cat'            => $request[$RequestFiledLang],
                    'lang_id'             => $key->id,
                    'image_name'          => $name_image,
                    'translation_id'      => $request->translation_id,
                ]);
            }

            $this->UploadFile($request->file , 'images/Catagories' , $name_image);

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
