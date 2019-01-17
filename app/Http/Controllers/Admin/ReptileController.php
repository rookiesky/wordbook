<?php
namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;


class ReptileController extends Controller
{
    protected $link = 'https://b.sis.la/page/';
    protected $web = 'https://b.sis.la';
    protected $number = 2;
    protected $total = 30;
    protected $star_number = 13;

    public function index()
    {
        $this->number = $this->getCacheNumber();
        $data = $this->getList();
        $this->store($data);
        $this->setCacheNumber($this->number + 1);
        echo "Success";
    }

    private function getCacheNumber()
    {
        if(Cache::has('link_number')){
            return Cache::get('link_number');
        }
        $this->setCacheNumber($this->number);
        return $this->number;
    }

    private function setCacheNumber($number)
    {
        Cache::put('link_number',$number,30);
    }

    private function store($data)
    {
        foreach ($data as $item){
            Book::create($item);
        }
    }

    private function getList(){
        $list = $this->getContent($this->link . $this->number);
        $preg = '/<a[^>]*href=[\'"]([^"]*)[\'"][^>]*>(.*?)<\/a>/';
        preg_match_all($preg,$list,$result,PREG_SET_ORDER);

        $body = array();
        for ($i = 13; $i < $this->totalNumber(); $i++){

            if($i%2 !==0){
                $body[$i]['sort_id'] = $this->getSort($result[$i][2]);
            }else{
                $body[($i - 1)]['title'] = $result[$i][2];
                $body[($i - 1)]['content'] = $this->getBody($this->web . $result[$i][1]);
            }
        }
       return $body;
    }


    private function getBody($url)
    {
        $content = $this->getContent($url);
        $preg = '/<div class=\"entry-content\".*?>(.*?)<\/div>/ism';
        preg_match_all($preg,$content,$result,PREG_SET_ORDER);
        return $result[0][1];
    }

    private function totalNumber()
    {
        return $this->star_number + ($this->total * 2);
    }

    private function getSort($title)
    {
        switch ($title){
            case '都市生活成人文學':
                return 1;
                break;
            case '人妻熟女成人文學':
                return 2;
                break;
            case '家庭亂倫成人文學':
                return 3;
                break;
            case '學生校園成人文學':
                return 4;
                break;
            case '情色武俠成人文學':
                return 5;
                break;
            default:
                return 6;
        }
    }

    private function getContent($link)
    {
        return file_get_contents($link);
    }
}