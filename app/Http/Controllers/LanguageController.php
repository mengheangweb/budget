<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch($lang)
    {
        if(! in_array($lang, ['kh', 'en']))
        {
            abort('404');
        }

        session()->put('lang', $lang);

        return redirect()->back();
    }
}
