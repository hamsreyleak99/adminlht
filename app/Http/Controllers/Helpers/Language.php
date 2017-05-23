<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Language
{
   
	// check langauge
    public static function checkLang($langInput)
    {
        $langInput=strtolower($langInput);

        if($langInput!=null)
        {
            $langInput = self::setLang($langInput);
            Session::put('lang',$langInput);
        }
        if(Session::get('lang')==null)
        {
            /*gernerate encrypt_lang*/
            $key=env('APP_KEY');
            $id=sha1('lang');
            $first=substr(sha1($id),0,5);
            $last=substr(sha1($id),-5);
            $id=$first.sha1($key).sha1(App::getLocale()).$last;//detfault lang set to session if not  set
            $lang=e(sha1($id));
            
            Session::put('lang',$lang);
        }else
        {
            self::getLang();
        }
        return Session::get('lang');
    }  

    // set langauge
    public static function setLang($lang)
    {
        /*gernerate encrypt_lang*/
        $key=env('APP_KEY');
        $id=sha1('lang');
        $first=substr(sha1($id),0,5);
        $last=substr(sha1($id),-5);
        $id=$first.sha1($key).sha1($lang).$last;
        return $lang=e(sha1($id));
    }
    // get langauge
    public static function getLang()
    {
        switch (Session::get('lang')) {
            case self::setLang('en'):
               break;

            case self::setLang('kh'):
               break;
           default:
                Session::put('lang', self::setLang('en'));
               break;
       }   
    }
    // get title langauge
    public static function getTitleLang()
    {
        $titleLang;
        switch (Session::get('lang')) {
            case self::setLang('en'):
                $titleLang='en';
                break;
            case self::setLang('kh'):
                $titleLang='kh';
                break;
            default:
                Session::put('lang', $this->setLang('en'));
                $titleLang='en';
                break;
        }
        return $titleLang;
    }
}
