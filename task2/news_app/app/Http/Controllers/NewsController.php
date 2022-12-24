<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function ShowMainPage(){
        return view('NewsTemplate');
    }

    public function CreateNews(){
        return view('NewsTemplate', ['action' => 'create']);
    }
    
    public function RegisterNews(Request $request){
        // валидация
        $news = new News();
        return $news->CreateNews($request);
    }

    public function DeleteNews(Request $request){
        // валидация
        $news = new News();
        return $news->DeleteNews($request);
    }

    public function ShowNews(Request $request){
        // валидация
        $news = new News();
        return $news->ShowNews($request);
    }
}
