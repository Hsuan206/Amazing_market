<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use Session;
use Illuminate\Support\Facades\Auth;
class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //$request為我在single-blade中的留言表格
    public function store(Request $request, $post_id)
    {
        //$request就是前端送進的資料, 包含message
        $this->validate($request, array('message'=>'required|min:5|max:2000'));

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;//直接抓登入的使用者
        //$comment->email = $request->email;
        $comment->content = $request->message;
        //$comment->approved = true;
        $comment->article_id = $post_id;
        $comment->save();

        //191213
        //$post=$post->id;
        //Session::flash('success','Comment was added');
        //return redirect()->route('blog.single', [$post->slug]);
    }
    /*
    protected function formatValidationErrors(Validator $this)
    {
        return $this->errors()->all();
    }
    */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
