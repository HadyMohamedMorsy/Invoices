<?php
namespace App\Traits;

use App\Models\Languages;
use App\Models\Catagories;
use App\Models\products;
use App\Traits\LanguagesTrait;
use Mockery\Undefined;
use Stichoza\GoogleTranslate\GoogleTranslate;


trait TranslateAutoTrait {

    use LanguagesTrait;
    
    public function TranslateAutoCatTrait($nameModel) {

        // Last Id Language Table
        $idLang =  $this->Languages();

        if($this->ModelName($nameModel , first :'first')){

            // Last Model id 
            $LastModelId =  $this->ModelName($nameModel , order :'order');
            
            if($LastModelId != $idLang){

                // Different Language If We Have Many language On Our System Or Not 
                $differenceLangId = $idLang - $LastModelId;

                $lanItem = Languages::get('id');
                
                foreach ($lanItem as $key => $value) {

                    $arrLang[] = $value->id;
                }

                // Get Id Different Lang 
                $takeLanguageId =  array_splice($arrLang , - $differenceLangId);

                // Get Lang Slug Differences
                foreach( $takeLanguageId as $key) {

                    $takeLangSlug[] = Languages::where('id' , $key)->get(['Language_name' , 'id']);
                }

                // get slug and  Id 
                foreach( $takeLangSlug as $key) {

                    foreach ($key as $newKey) {

                        $filterSlug[] =  $newKey->Language_name;

                        $idLanguage[] =  $newKey->id;
                    }
                }

                // get all translation_id
                foreach($this->ModelName($nameModel , all :'all') as $key){

                    $checkId[] = $key->translation_id;
                }

                // get unique translation_id
                $checkIdUnique = array_unique($checkId);

                // get Value translation_id
                $values = array_values($checkIdUnique);

                foreach($checkIdUnique as $key){
                    switch($nameModel){
                        case 'Catagories':
                            $allName[] =   Catagories::where('translation_id' ,  $key)->first()->name_cat;           
                            $allImages[] = Catagories::where('translation_id' ,  $key)->first()->image_name;
                        break;
                        case 'products':
                            $allName[]   = products::where('translation_id' ,  $key)->first()->name_product;           
                            $allDesc[]   = products::where('translation_id' ,  $key)->first()->description;
                            $allPrice[]  = products::where('translation_id' ,  $key)->first()->price;
                            $allImages[] = products::where('translation_id' ,  $key)->first()->image_name;
                        break;
                    } 
                }
    
                for ($i=0; $i < count($filterSlug); $i++) { 

                    for ($x=0; $x < count($checkIdUnique); $x++) { 

                        $tr = new GoogleTranslate($filterSlug[$i]);

                        switch($nameModel){
                            case 'Catagories':
                            Catagories::create([
                                'name_cat'              => $tr->translate($allName[$x]),
                                'lang_id'               => $idLanguage[$i],
                                'image_name'            => $allImages[$x],
                                'translation_id'        => $values[$x],
                            ]);
                            break;
                            case 'products':
                            products::create([
                                'name_product'          => $tr->translate($allName[$x]),
                                'description'           => $tr->translate($allDesc[$x]),
                                'price'                 => $allPrice[$x],
                                'lang_id'               => $idLanguage[$i],
                                'image_name'            => $allImages[$i],
                                'translation_id'        => $values[$i],
                            ]);
                            break;
                        }
                    }
                }
            }
        }
        
    }

    protected function ModelName($nameModel , $first = null , $all = null , $order = null){

        if($nameModel == 'Catagories'){
            
            if($first == 'first'){

                return Catagories::first();
            }

            if($all == 'all'){
                return Catagories::all();
            }

            if($order == 'order'){

                return Catagories::orderBy('lang_id', 'desc')->first()->lang_id;
            }
        }else{

            if($first == 'first'){

                return products::first();
            }

            if($all == 'all'){

                return products::all();
            }

            if($order == 'order'){

                return products::orderBy('lang_id', 'desc')->first()->lang_id;
            }
        }

    }
}