<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use Illuminate\Support\Facades\Auth;
use Session;
class CollectionController extends Controller
{
    // 撈所有的收藏
    public function getCollection(){
        $collecions = Collection::all();
        return view('template.index',[
                'abc'=> $collecions
            ]);
    }
    // 獲得OpenData的資料
    public function getOpenData(){
        if(Session::has('opendata')){
            $jsonOpenData = Session::get('opendata');
        }else{
            // $xml = file_get_contents(public_path('data/0102.json'));
            $xml = file_get_contents("http://data.coa.gov.tw/Service/OpenData/FromM/FarmTransData.aspx");
            $jsonOpenData = json_decode($xml);
            Session::put('opendata',$jsonOpenData);
        }
        return $jsonOpenData;
    }
    // 新增收藏
    public function create(Request $request){
    	$collection = new Collection();
    	$collection->user_id = Auth::user()->id;
    	$collection->vg_id = $request->vg_id;
        $collection->vg_name = $request->vg_name;
    	$collection->mrk_id = $request->mrk_id;
        $collection->mrk_name = $request->mrk_name;
    	$collection->save();
    }

    // 刪除收藏
    public function delete(Request $request){
    	// $collection = Collection::where('user_id','=',Auth::user()->id)->where('mrk_id','=',$request->mrk_id)->where('vg_id','=',$request->vg_id)->first();
        $collection = Collection::where('user_id','=',Auth::user()->id)->where('mrk_id','=',$request->mrk_id)->where('vg_id','=',$request->vg_id)->first();
    	$collection->delete();
    }

    // 獲得特定使用者的收藏
    public function getCollectionByUser(){
        // 有登入才去找
        $collections = Collection::where('user_id','=',Auth::user()->id)->get();
        return $collections->toJSON();
    }
}
