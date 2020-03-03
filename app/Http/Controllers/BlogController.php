<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//import Article 這個 Model
use App\Article;
use App\User;
use App\Comment;

class BlogController extends Controller
{
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    /*
    Article Module:
        - getArticle(): 點 navbar 的 blog 顯示文章列表
        - store(Request $request): 新增文章
        - showArticle(Article $article): 點查看更多顯示的文章
        - userArticlelist(): 點 nav 右上角的人名進入到個人文章列表
        - updateArticle(Request $request, $articleID): 更新文章
        - deleteArticle(Request $request, $articleID): 刪除文章
    */   
    public function getArticle(){
        
        // model 跟 DB 拿資料
        // orderByRaw 設定一個原生字串作為 order by 子句的值，由大到小排
        // 測試分頁只顯示3個篇文章取代all()
        
        $articles = Article::orderByRaw('created_at DESC')->paginate(3);

        // return view('view的路徑', ['傳遞到view的參數名稱'=>上面那行取出的資料])
        // view 會使用 @傳遞到view的參數名稱 來取得資料
        Return view('/template.blog', ['articles'=>$articles]);
        // 在這裡創造了黃色的articles(arts), 在template.blog中會用到$arts

    }
    
//    public function imageUploadPost()
//
//    {
////        request()->validate([
////
////            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
////        ]);
//        $imageName = time().'.'.request()->image->getClientOriginalExtension();
//        request()->image->move(public_path('userimage'), $imageName);
//
//    }
    
    // 對應 blog.blade.php 253 行開始
    public function storeArticle(Request $request){
        
        try {
            
//            $this->validate($request, [
//                'uploadurl'=>'require|image|mimes:jpeg,png,jpg,gif,svg|max:20480'
//                
//            ]);
//            $imageName = time().'.'.$request->uploadurl->getClientOriginalExtension();
//            $request->uploadurl->move(public_path('template/images'), $imageName);
            
            
            // Model: 'user_id', 'title', 'content', 'comments_id', 'img_url'
            $article = new Article();

            // 登入的人才能新增文章，所以要知道是哪個使用者
            $article->user_id = Auth::user()->id;
            
            // 從 view 中的 form post 進來的資料
            $article->title = $request->title;
            $article->content = $request->content;
            // 在 blog.blade.php 中的73行儲存作為要 post 進資料庫的圖片 URL
            $article->img_url = $request->cache_url;

            // 新增資料到 DB
            $article->save();
            
        } catch(Exception $e) {
            
            return view('/template.blog');
            
        }
        
    }
    // blog-single.blade.php 從 17 行開始
    public function showArticle(Article $article){
    //Article為Modle中的class, 就像是int $article, 這邊的$article是變數
       //$comments = Comment::paginate(3);
       $comments = Comment::where('article_id','=',$article->id)->get();
       foreach ($comments as $comment) {
           $comment->username = User::find($comment->user_id)->name;
           // find直接用來找pk(唯一值), 從comment的Model中取'user_id', 找到user_id後再去User的Model中取name
           $date = date_format($comment->created_at, 'Y-m-d');
           // 取整段created_at中的日期, single中的foreach會使用到
           $time = date_format($comment->created_at, 'g:i A');
           // 取整段created_at中的時間, single中的foreach會使用到
           $comment->date = $date;
           $comment->time = $time;
       }
        return view('template.blog-single', ['article' => $article, 'comments'=>$comments]);
        //而我這個public的function創造了黃色的article(a), 在blog-single的view中會用到$a
        // 這邊的$article就是上面class創造的
        
    }
    // blog-personal.blade.php 從 116 行開始
    public function userArticleList(){
        
        # 判斷使否已經登入
        if(Auth::check()){
            # model 跟 DB 拿資料
            $articles = Article::where('user_id', '=', Auth::user()->id)->paginate(3);
            return view('template.blog-personal', ['articles' => $articles]);
        }
        else{
            
            # 返回登入
            return view('auth.login');
        }
        
    }
    // blog-personal.blade.php 從 49 行開始
    public function updateArticle(Request $request){
        
        try {
            // 取得哪一個文章要更新
            $article = Article::where('id',$request->id);
            // 只更新內容，因為不允許更動title
            $article->update(['content'=>$request->content]);
        } catch(Exception $e) {
            
            return view('/template.blog-personal');
        }
            
    }
     // blog-personal.blade.php 從 91 行開始
    public function deleteArticle(Request $request){
        
        try {
            // 取得是哪一個文章要刪除
            $article = Article::where('id',$request->id);
            // 刪除文章
            $article->delete();
        } catch(Exception $e) {
            
            
            return view('/template.blog-personal');
        }

    }
            
}
