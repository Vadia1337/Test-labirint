<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'preview',
        'text',
        'tags',
    ];

    // магические методы не использовались.

    public function getId(){
        return $this->id;
    }

    public function getHeader(){
        return $this->header;
    }

    public function setHeader($value){
        $this->attributes['header'] = $value;
    }

    public function getPreview(){
        return $this->preview;
    }

    public function setPreview($value){
        $this->attributes['preview'] = $value;
    }

    public function getText(){
        return $this->text;
    }

    public function setText($value){
        $this->attributes['text'] = $value;
    }

    public function getTags(){
        return $this->tags;
    }

    public function setTags($value){
        $this->attributes['tags'] = $value;
    }

    public function getDate(){
        return $this->created_at->format('d.m.Y H:m:s');
    }

    public function CreateNews($request){
        self::create([
            'header' => $request->header,
            'preview' => $request->preview,
            'text' => $request->text,
            'tags' => $request->tags,
        ]);
        return 'good-create-news';
    }

    public function ShowNews($request){

        if(isset($request->id)){

            $ckeckById = $this->where('id', $request->id)->count();
            if($ckeckById != 0){
                $showNews = $this->where('id', $request->id)->first();
                return view('NewsTemplate', ['action' => 'shownews', 'news' => $showNews]);
            }

        }else if(isset($request->q)){

            $ckeckByQ = $this->where('header', 'like', '%'.$request->q.'%')->count();
            if($ckeckByQ != 0 && isset($request->q)){
                
                $showNews = $this->where('header', 'like', '%'.$request->q.'%')->first();
                return view('NewsTemplate', ['action' => 'shownews', 'news' => $showNews]);
            }

        }else{
            return 'Параметр не передан';
        }
    }

    public function DeleteNews($request){
        $ckeck = $this->where('id', $request->id)->count();
        if($ckeck != 0){
            $this->where('id', $request->id)->first()->delete();
            return view('NewsTemplate', ['action' => 'deletenews']);
        }else{
            return 'Внимание! записи, где id=' .$request->id. ' - не существует.';
        }
    }
}

