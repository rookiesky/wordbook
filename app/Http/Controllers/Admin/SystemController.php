<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Date: 2018/12/21
 * Time: 22:34
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SystemController extends Controller
{

    protected $cache_name = 'SYSTEM_CACHE';

    public function index()
    {
        $system = System::orderBy('id','desc')->first();
        return view(self::ADMIN_VIEW_PREFIX . '.system.index',compact('system'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $system = System::orderBy('id','desc')->first();

        if(empty($system)){
            $result = System::create($data);
        }else{
            $result = System::where('id',$system->id)->update($data);
        }

        if($result){
            $this->setCache();
            return response()->json(['message'=>'提交成功']);
        }
        return response()->json(['message'=>'提交失败'],500);
    }

    public function getCache()
    {
        $name = $this->cache_name;

        if(Cache::has($name)){
            return Cache::get($name);
        }
        return $this->setCache();
    }


    private function setCache()
    {
        $data = System::first();
        Cache::forever($this->cache_name,$data);
        return $data;
    }
    
}