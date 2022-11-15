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

use Storage;

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

        $this->TranslateAutoCatTrait();

        $GetDataByLang = Languages::where('Language_name' , LaravelLocalization::getCurrentLocale())->first()->id;

        $Catagories =  Catagories::where('lang_id', $GetDataByLang)->paginate(5);

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
            
            // Uploaded The Image On The system 
            $file_extension = $request->file->getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $request->file->move('images/Catagories' , $file_name);

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
    public function update(Request $request , $id)
    {
        $language_id = Languages::where('Language_name' , LaravelLocalization::getCurrentLocale())->first()->id;

        $showCategory =  Catagories::where('translation_id' , $id)->where('lang_id' , $language_id);

        $TakeImage =  $showCategory->first()->image_name;

        $file_path = public_path().'/images/Catagories/'.$TakeImage;

        if($file_path) {

            unlink($file_path);

        }

        $validFiled = 'name_cat_'.LaravelLocalization::getCurrentLocale();

        // Uploaded The Image On The system 
        $file_extension = $request->file->getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $request->file->move('images/Catagories' , $file_name);

        $showCategory->update([
            'name_cat'      => $request[$validFiled],
            'image_name'    => $this->NameFile($file_name), 
        ]);

        return redirect('/catagories')->with("updated","This catagories Is updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catagories  $catagories
     * @return \Illuminate\Http\Response
     */
    public function destroy($translation_id)
    {

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

        // Uploaded The Image On The system 
        $this->UploadFile($request->file , 'images/Catagories');

            foreach($languagesData as $key){

                $RequestFiled = 'name_cat_'.$key->Language_name;

                Catagories::create([
                    'name_cat'            => $request[$RequestFiled],
                    'lang_id'             => $key->id,
                    'image_name'          => $this->NameFile($request->file),
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
