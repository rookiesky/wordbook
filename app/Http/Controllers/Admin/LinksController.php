<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Link;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index()
    {
        $links = Link::orderBy('order','asc')->paginate(20);
        return view(self::ADMIN_VIEW_PREFIX . '.system.link.index',compact('links'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        $title = $request->get('title');

        $links = Link::where('title','like',"%{$title}%")->orderBy('order','asc')->paginate(20);
        return view(self::ADMIN_VIEW_PREFIX . '.system.link.index',compact('links'));
    }

    public function create()
    {
        return view(self::ADMIN_VIEW_PREFIX . '.system.link.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
        ]);

        $data = $request->only(['title','order','url']);


        if(Link::create($data)){
            return response()->json(['message'=>'增加成功']);
        }
        return response()->json(['message'=>'提交失败'],500);
    }

    public function edit($id)
    {
        $link = Link::find($id);
        if(empty($link)){
            return redirect(self::ADMIN_PREFIX . '/system/link');
        }
        return view(self::ADMIN_VIEW_PREFIX . '.system.link.edit',compact('link'));
    }

    public function update( Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'id' => 'required'
        ]);

        $data = $request->only(['title','url','id','order']);

        $link = Link::find($data['id']);

        if(empty($link)){
            return response()->json(['message'=>'没有该链接'],404);
        }

        $link->title = $data['title'];
        $link->url = $data['url'];
        $link->order = $data['order'];

        if($link->save()){
            return response()->json(['message'=>'修改成功']);
        }
        return response()->json(['message'=>'提交失败'],500);
    }

    public function destroy($id)
    {
        $link = Link::find($id);
        if(empty($link)){
            return response()->json(['message'=>'link is empty'],404);
        }
        if($link->delete()){
            return response()->json(['message'=>'删除成功']);
        }
        return response()->json(['message'=>'提交失败'],500);
    }
}