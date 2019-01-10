<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ReptileController extends Controller
{
    protected $link = 'https://b.sis.la/page/';
    protected $number = 1;

    public function index()
    {
        $this->number = 1;
        $data = $this->getList();
            dd($data);
    }

    private function getList(){
        $list = $this->getContent($this->link . $this->number);
        $preg = '/<td class="entry-content"><a[^>]*href=[\'"]([^"]*)[\'"][^>]*>(.*?)<\/a><\/td>/';
        preg_match_all($preg,$list,$result,PREG_SET_ORDER);
        return $result;
    }

    private function getContent($link)
    {
        return file_get_contents($link);
    }
}