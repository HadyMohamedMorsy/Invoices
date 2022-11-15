<?php
namespace App\Traits;

use App\Models\Languages;
use App\Models\Catagories;
use App\Traits\LanguagesTrait;

trait TranslateAutoCatTrait {

    use LanguagesTrait;
    
    public function TranslateAutoCatTrait() {

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
                    
                    $allImages[] = Catagories::where('translation_id' ,  $key)->first()->image_name;
                }
         
                for ($i=0; $i < count($filterSlug); $i++) { 

                    for ($x=0; $x < count($checkIdUnique); $x++) { 

                        $tr = new GoogleTranslate($filterSlug[$i]);

                        Catagories::create([
                            'name_cat'              => $tr->translate($allName[$x]),
                            'lang_id'               => $idLanguage[$i],
                            'image_name'            => $allImages[$x],
                            'translation_id'        => $values[$x],
                        ]);
                    }
                }
            }
        }
        
    }
}