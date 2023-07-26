<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;

class NewsController extends Controller
{
    /*-------------------------------------------создание-----------------------------------------*/
    public function postCreateNews(Request  $request){
        try{
            $file = $request->file('img');
            Storage::putFileAs('public/', $file, $file->getClientOriginalName());
            $news = new News();
            $news->title                = $request->title;
            $news->description          = $request->description;
            $news->text                 = $request->text;
            $news->publication_date     = $request->publication_date;
            $news->img_url              = $file->getClientOriginalName();
            $news->save();

            return response()->json([
                'message'=>'Запись прошла успешно'
            ], 200);
        }catch (Exception $e){
            return response()->json([
                'message'=>'произошла ошибка'
            ], 500);
        }
    }

    /*-------------------------------------------обновление-----------------------------------------*/
    public function postUpdateNews(Request  $request){
        try{
            $news = News::find($request->id);
            $news->title                = $request->title;
            $news->description          = $request->description;
            $news->text                 = $request->text;
            $news->publication_date     = $request->publication_date;
            $news->img_url              = $request->img_url;
            $news->update();

            return response()->json([
                'message'=>'Обновление прошло успешно'
            ], 200);
        }catch (Exception $e){
            return response()->json([
                'message'=>'произошла ошибка'
            ], 500);
        }
    }

    /*-------------------------------------------удаление-----------------------------------------*/
    public function postDeleteNews(Request $request){
        try {
            $news = News::find($request->id)->delete();
            return response()->json([
                'message'=>'Удаление прошло успешно'
            ], 200);
        }catch (Exception $e){
            return response()->json([
                'message'=>'Во время удаления произошла ошибка'
            ], 500);
        }
    }

    /*------------------------------------------получение всех новостей---------------------------------------*/
    public function getNews(){
        try{
            $news = News::all();
            return isset($news)?response()->json(['data'=>$news, 'message'=>'Успех']): response()->json(['message'=>'Ссылка устарела', 'data'=>null]);
        }catch (Exception $exception){
            return response()->json(['message' => 'Произошла ошибка', 500]);
        }
    }

    /*-------------------------------------------получение по id-----------------------------------------*/
    public function postFullNews(Request $request){
        try{
            $news = News::find($request->id);
            return isset($news)?response()->json(['message'=>'Успех', 'data'=>$news]):response()->json(['message'=>'Ссылка устарела', 'data'=>null]);
        }
        catch (Exception $e){
            return response()->json(['message' => 'Произошла ошибка', 500]);
        }
    }

}
