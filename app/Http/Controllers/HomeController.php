<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Controllers\Admin\SortController;
use App\Http\Controllers\Admin\SystemController;
use App\Link;
use App\Sort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Vinkla\Hashids\Facades\Hashids;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        (new SystemController())->getCache();
        (new SortController())->getCache();
        $book_model = new Book();
        $books_id = $book_model::orderBy('created_at','desc')->take(60)->get(['id']);
        $books = $book_model::whereIn('id',array_column($books_id->toArray(),'id'))->with('sort')->orderBy('created_at','desc')->paginate(20);
        $hots = $book_model::orderBy('view','desc')->limit(15)->get();
        $links = Link::orderBy('order','asc')->get(['title','url','order']);
        return view(self::HOME_VIEW_PREFIX . '.index.index',compact(['books','hots','links']));
    }


    public function lists($id)
    {
        try{
            $sort = Sort::where('id',Hashids::decode($id))->first();
        }catch (\Exception $exception){
            return abort(404);
        }

        if(empty($sort)){
            return abort(404);
        }

        return view(self::HOME_VIEW_PREFIX . '.index.list',compact(['sort']));
    }
    
    public function article($id)
    {
        try{
            $book = Book::where('id',Hashids::decode($id))->first();
        }catch (\Exception $exception){
            return abort(404);
        }
        if(empty($book)){
            return abort(404);
        }
        $this->updateArticleViewNumber($book->id);
        return view(self::HOME_VIEW_PREFIX . '.index.article',compact('book'));
    }

    public function search(Request $request)
    {
        $keyword = $request->get('keyword');

        if(empty($keyword)){
            $books = [];
        }
        $books = Book::where('title','like',"%{$keyword}%")->orderBy('created_at','desc')->with('sort')->paginate(20);
        if($books->isEmpty()){
            $books = [];
        }

        return view(self::HOME_VIEW_PREFIX . '.index.search',compact(['books','keyword']));
    }

    public function updateViewNumber()
    {
        $name = 'article_number';
        if(!Cache::has($name)){
            return response()->json('Cache is not data');
        }

        $number = Cache::get($name);
        if(empty($number)){
            return response()->json('Cache is empty');
        }

        $book_model = new Book();
        $books = $book_model->whereIn('id',array_keys($number))->get(['id','view']);
        if($books->isEmpty()){
            return response()->json('data is empty');
        }

        foreach (collect($books)->chunk(100)[0] as $item){
            $item->view = $item->view + $number[$item->id];
            $item->save();
            unset($number[$item->id]);
        }
        Cache::forever($name,$number);
        return response()->json('Success');
    }


    private function updateArticleViewNumber($id)
    {
        $name = 'article_number';
        if(Cache::has($name)){
            $article_number = Cache::get($name);
            if(isset($article_number[$id])){
                $article_number[$id] = $article_number[$id] + 1;
            }else{
                $article_number[$id] = 1;
            }
        }else{
            $article_number[$id] = 1;
        }
        Cache::forever($name,$article_number);
    }
}
