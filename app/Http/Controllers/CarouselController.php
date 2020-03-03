<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carousel;
use Illuminate\Support\Facades\Auth;
use File;
class CarouselController extends Controller
{
	// 顯示幻燈片管理頁面
    public function manageCarousel(){
    	$carousels = Carousel::all();
        return view('template.carousel',["carousels"=>$carousels]);
    }
    // 新增幻燈片
    public function createCarousel(Request $request){
        $carousel = new Carousel;
        $carousel->title= $request->title;
        $carousel->hint= $request->hint;
        $this->validate($request, [
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageName = time().'.'.$request->img->getClientOriginalExtension();
        $request->img->move(public_path('carousel_Img'), $imageName);
        $carousel->img_url= $imageName;
        $carousel->save();
        return redirect('/carousel'); //回管理者專區首頁
    }
}
