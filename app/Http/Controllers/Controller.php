<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function customResponseJsonList($response,$page,$items,$url,$message=null){
        
        if($response->ok()){
            $data=json_decode($response->body(),true);
            $json_response = [
                'status' => 'success',
                'statusCode' => $response->status(),
                'data' => $data,
            ];

            $pagination=$this->getPaginationLinks($page,$items,$data,$url);
            if($pagination!=null){
                    $json_response['pagination']=$pagination;

            }
    
            if ($message != null) {
                    $json_response['message'] = $message;
            }
            
            return response()->json($json_response, $response->status());    
        }

        return json_decode($response->body(),true);
         
    }


    protected function getPaginationLinks($page,$items,$data,$url){

        $pagination=null;
        if(sizeof($data)==0)
            return $pagination;
        if($page>1)
            $pagination[]=['prev'=>$url.'?page='.($page-1).'&items='.$items];
        if(sizeof($data)==$items ) //ci protrebbero essere altri risultati     
           $pagination[]=['next'=>$url.'?page='.($page+1).'&items='.$items];
     
        return $pagination;

    }

   
}
