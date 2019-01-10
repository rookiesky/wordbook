<?php
namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use App\Sort;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index($id)
    {
        $sort = Sort::where('id',$id)->first();
        $books = $sort->books()->orderBy('id','desc')->paginate(20);
        return view(self::ADMIN_VIEW_PREFIX . '.book.index',compact(['sort','books']));
    }

    public function search(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        $title = $request->get('title');
        $books = Book::where('title','like',"%{$title}%")->paginate(20);
        return view(self::ADMIN_VIEW_PREFIX . '.book.search',compact(['books']));
    }

    public function create($id)
    {
        $sort = Sort::find($id);
        if(empty($sort)){
            return response()->json(['message'=>'sort empty'],404);
        }
        return view(self::ADMIN_VIEW_PREFIX . '.book.create',compact('sort'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'sort_id' => 'required'
        ]);
        $data = $request->only(['title','content','sort_id']);

        $sort = Sort::find($data['sort_id']);
        if(empty($sort)){
            return response()->json(['message'=>'分类不存在'],404);
        }

        if(Book::create($data)){
            return response()->json(['message'=>'增加成功！']);
        }
        return response()->json(['message'=>'提交失败！'],500);
    }

    public function edit($id)
    {
        $book = Book::find($id);
        if(empty($book)){
            return response()->json(['message'=>'文章不存在'],404);
        }

        return view(self::ADMIN_VIEW_PREFIX . '.book.edit',compact('book'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sort_id' => 'required',
            'content' => 'required',
            'id' => 'required'
        ]);

        $data = $request->only(['title','sort_id','content','id']);
        $model = new Book();

        if(! $model->find($data['id'])){
            return response()->json(['message'=>'文章不存在！']);
        }

        if($model->where('id',$data['id'])->update($data)){
            return response()->json(['message'=>'修改成功']);
        }

        return response()->json(['message'=>'提交失败'],500);

    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if(empty($book)){
            return response()->json(['message'=>'文章不存在'],404);
        }

        if($book->delete()){
            return response()->json(['message'=>'删除成功']);
        }
        return response()->json(['message'=>'提交失败'],500);
    }

}