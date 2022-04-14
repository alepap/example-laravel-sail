<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class BeerController extends Controller
{
    
    
    private $route="beers";
    private $maxLimit=80;
    private $defaultLimit=25;
    
    public function indexV1(Request $request){

        $page=1;
        if(($request->has('page') && $request->query('page')>0))
            $page=$request->query('page');

        $items=$this->defaultLimit;
        if($request->has('items') && $request->query('items')>1 && $request->query('items')<=$this->maxLimit)
            $items=$request->query('items');

        

        $response = Http::get(env('URL_REQUEST').$this->route,[
            'page'=> $page,
            'per_page'=>$items
        ]);

      
       
        return $this->customResponseJsonList($response,$page,$items,$request->url());
       
    }

   
  
}
