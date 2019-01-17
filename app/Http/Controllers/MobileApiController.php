<?php
namespace App\Http\Controllers;

use App\Book;
use App\Http\Controllers\Admin\SortController;
use App\Sort;
use App\Transformers\BookTransformer;
use App\Transformers\ListTransformer;
use App\Transformers\SortTransformer;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;


class MobileApiController extends Controller
{

    protected $listTransformer;

    /**
     * MobileApiController constructor.
     * @param $listTransformer
     */
    public function __construct(ListTransformer $listTransformer)
    {
        $this->listTransformer = $listTransformer;
    }

    public function lists(Request $request)
    {

       $sort_id = Hashids::decode($request->get('hash'))[0];

       $sort = Sort::where('id',$sort_id)->first();
       if(empty($sort)){
            return response()->json(['code'=>404,'data'=>''],404);
       }

      $books = ($sort->booksPaginate())->toArray();

       return response()->json([
           'code' => 200,
           'data' => [
               'data' => $this->listTransformer->transformCollection($books['data']),
               'current_page' => $books['current_page'],  //当前页
               'last_page' => $books['last_page'],  //最后一页
               'per_page' => $books['per_page'],    //每页条数
               'next_page_url' => $books['next_page_url'],  //下一页地址
               'prev_page_url' => $books['prev_page_url'],  //上一页地址
               'total' => $books['total']   //总条数
           ]
       ]);
    }

    public function newest()
    {
        $books = Book::orderBy('created_at','desc')->limit(20)->get();
        if($books->isEmpty()){
            return response()->json(['code'=>404,'data'=>''],404);
        }
        return response()->json([
            'code'=>200,
            'data' => $this->listTransformer->transformCollection($books->toArray())
        ]);
    }

    public function sort()
    {
        $sort = (new SortController())->getCache();

        return (new SortTransformer())->transformCollection($sort->toArray());
    }

    public function getController(Request $request)
    {
        $id = Hashids::decode($request->get('hash'));
        if(empty($id)){
            return response()->json(['code'=>404,'data'=>''],404);
        }
        $book = Book::where('id',$id)->first();
        if(empty($book)){
            return response()->json(['code'=>404,'data'=>''],404);
        }
        return response()->json([
            'code' => 200,
            'data' => (new BookTransformer())->transformer($book->toArray())
        ]);
    }
}