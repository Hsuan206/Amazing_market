<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('content');
            $table->integer('article_id');//此則留言屬於哪篇文章的
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::dropForeign(['post_id']);
        //必須要kill foreign key constraint, 所以要做drop foreign, 移除foreign key
        Schema::dropIfExists('comments');
        //移除掉comments table
        
        
    }
}

/*
class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('article_id');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /*
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
*/

/*
class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*
    public function up()
    {
        /*
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id'); //這是什麼
            //$table->integer('user_id');
            //$table->text('content');
            $table->engine = 'InnoDB';
            $table->string('name');
            $table->string('email');
            $table->text('comment');
            $table->boolean('approved');
            $table->integer('article_id')->unsigned();

            $table->timestamps();
            /*
            $table->foreign('post_id')//?comment資料表內有個post_id欄位要參考至post資料表的id欄位
            ->reference('id')->on('post')
            ->onDelete('cascade');//你也可以指定約束的「on delete」及「on update」作為所需的操作   
            */   
        //});
        
   
        /*Schema::table('comments',function ($table){
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
            //?comment資料表內有個post_id欄位要參考至post資料表的id欄位
            //你也可以指定約束的「on delete」及「on update」作為所需的操作     
    }