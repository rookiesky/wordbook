<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SortController extends Controller
{

    protected $cache_name = 'SORT_CACHE';

    public function index()
    {
        $sort = Sort::orderBy('order','asc')->get();
        return view(self::ADMIN_VIEW_PREFIX . '.sort.index',compact('sort'));
    }

    public function create()
    {
        return view(self::ADMIN_VIEW_PREFIX . '.sort.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);
        $data = $request->only(['name','order']);

        if(Sort::create($data)){
            $this->setCache();
            return response()->json(['message'=>'新增成功']);
        }
        return response()->json(['message'=>'提交失败！'],500);
    }

    public function edit($id)
    {
        $sort = Sort::find($id);

        if(empty($sort)){
            return response()->json(['message'=>'sort empty'],404);
        }

        return view(self::ADMIN_VIEW_PREFIX . '.sort.edit',compact('sort'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id' => 'required'
        ]);
        $data = $request->only(['name','id','order']);

        if(Sort::where('id',$data['id'])->update($data)){
            $this->setCache();
            return response()->json(['message'=>'修改成功']);
        }
        return response()->json(['message'=>'提交失败'],500);
    }

    public function destroy($id)
    {
        $sort = Sort::find($id);
        if(empty($sort)){
            return response()->json(['message'=>'分类不存在'],404);
        }
        if($sort->delete()){
            $this->setCache();
            return response()->json(['message'=>'删除成功']);
        }
        return response()->json(['message'=>'提交失败'],500);
    }

    public function getCache(){
        $name = $this->cache_name;

        if(Cache::has($name)){
            return Cache::get($name);
        }
        return $this->setCache();
    }

    private function setCache(){
        $sort = Sort::orderBy('order','asc')->get();
        Cache::forever($this->cache_name,$sort);
        return $sort;
    }

}