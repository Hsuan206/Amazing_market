@extends('layouts.layout')
@section('title', '部落格')
@section('css')
<style type="text/css">
  body{
    margin: 0;
    padding: 0;
    background-color:#fff;
    font-family: arial
}

.box{
    margin:0 10%;
   
    padding: 10px 0 40px 60px
}

.box ul{
    list-style-type: none;
    margin: 0;
    padding: 0;
    position: relative;
    transition: all 0.5s linear;
    top:0
}

/*.box ul:last-of-type{top:80px}*/

.box ul:before{
    content: "";
    display: block;
    width: 0;
    height: 100%;
    border:1px dashed #7b8a4d;
    position: absolute;
    top:0;
    left:30px
}

.box ul li{
    margin: 20px 60px 60px;
    position: relative;
    padding: 10px 20px;
    background:#c9d69f;
    color:#000;
    border-radius: 10px;
    line-height: 20px;
    width: 80%
}


.box ul li > span{
    content: "";
    display: block;
    width: 0;
    height: 100%;
    border:1px solid #7b8a4d;
    position: absolute;
    top:0;
    left:-30px
}

.box ul li > span:before,.box ul li > span:after{
    content: "";
    display: block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background:#fff;
    border:2px solid #7b8a4d;
    position: absolute;
    left:-7.5px
}

.box ul li > span:before{top:-10px}
.box ul li > span:after{top:95%}

.box .title{
    text-transform: uppercase;
    font-weight: 700;
    margin-bottom: 5px
}

.box .info:first-letter{text-transform: capitalize;line-height: 1.7}

.box .name{
    margin-top: 10px;
    text-transform: capitalize;
    font-style: italic;
    text-align: right;
    margin-right: 20px
}


.box .time span{
    position: absolute;
    left: -100px;
    color:#7b8a4d;
    font-size:80%;
    font-weight: bold;
}
.box .time span:first-child{top:-16px}
.box .time span:last-child{top:94%}


.arrow{
  color:red;
    position: absolute;
    top: 105%;
    left: 22%;
    cursor: pointer;
  height:20px;
  width:20px;
}

.arrow:hover{
    -webkit-animation: arrow 1s linear infinite;
       -moz-animation: arrow 1s linear infinite;
         -o-animation: arrow 1s linear infinite;
            animation: arrow 1s linear infinite;
}

.box ul:last-of-type .arrow{
    position: absolute;
    top: 105%;
    left: 22%;
    transform: rotateX(180deg);
    cursor: pointer;
}

svg{
    width: 20px;
    height: 20px
}

@keyframes arrow{
    0%,100%{
        top:105%
    }
    50%{
        top:106%
    }
}

@-webkit-keyframes arrow{
    0%,100%{
        top:105%
    }
    50%{
        top:106%
    }
}

@-moz-keyframes arrow{
    0%,100%{
        top:105%
    }
    50%{
        top:106%
    }
}

@-o-keyframes arrow{
    0%,100%{
        top:105%
    }
    50%{
        top:106%
    }
}
</style>
@stop
@section('content')

    <div class="hero-wrap hero-bread" style="background-image: url({{ asset('template/images/bg_1.jpg') }});">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread" style="font-size:60px;">文章</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
            
          <div class="col-lg-2"></div>
          <div class="col-lg-8 ftco-animate">

            <div class="meta mb-3">
                <!-- 時間抓 DB 的 created_at -->
                <div style="padding-right:10px;">
                    <span>{{ substr($article->created_at, 0, 10) }}</span>
                    <span>{{ \App\User::where('id', $article->user_id)->value('name') }}</span>
                    <!-- 多少人留言也要去抓 -->
<!--                    <span class="icon-chat"> 3</span> -->
                </div>
            
            <!-- 放標題 -->
            <div style="margin: auto; font-size: 50px; text-align: center;">
                {{ $article->title }}
            </div>
            <!-- 放內容 -->
            <div>
                {!! $article->content !!}
            </div>

            <div class="box" id="commentBox">
            @foreach($comments as $comment)
            <ul>
                <li>
                    <span></span>
                    <div class="info">{{ $comment->content }}</div>
                    <div class="name">{{ $comment->username }}</div>
                    <div class="time">
                        <span>{{ $comment->date }}</span>
                        <span>{{ $comment->time }}</span>
                        <!-- 也可這樣寫{{ substr($article->created_at, 0, 10) }} -->
                    </div>
                </li>   
            </ul>
            @endforeach
            </div>
        <script src="JavaScript/timeline-V2.js"></script>

                  <!-- Auth::check() if使用者可以看到詳細內容(只有歷史記錄,不包括送出留言選項) -->

                 

                  @if(Auth::check())
                  <form>
                    <div class="form-group">
                      <label for="message">Message</label>
                      <textarea name="" id="message" cols="30" rows="10" class="form-control" required minlength="5" maxlength="2000" title="字數限制為5~2000字"></textarea>
                    </div>
                    <div class="form-group">
                      <button id="submitBtn" type="submit" value="Post Comment" class="btn py-3 px-4 btn-success">發表評論</button>
                    </div>
                 </form>
                  <!-- 將"發送評論"此按鈕取id名稱為submitBtn -->
                  <!-- label只能顯示, for中之黃色的message是自己取的名字-->
                  <!-- textarea可以輸入 -->
                  <!-- id是給js抓的(底下會使用到), name是給php抓的, 這邊不會使用到, 故不需要命名 -->  
                <!-- </form> -->          
                  @endif
              </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
      </div>
    </section> <!-- .section -->
@endsection
@section('js')

<!-- 外部引入的方式，讓js檔案執行, 告訴下面皆使用js撰寫 -->
<script type="text/javascript">



  //使用Auth::check(), if使用者可以看到詳細內容(只有歷史記錄,不包括送出留言選項)
  @if(Auth::check())
  // 當我按下ID為submitBtn的物件就要去執行的程式
  $(document).on("click","#submitBtn",function(){
    console.log("12321313123");
    // 傳送至資料庫, 按F12可以查看是否印出123, 有則代表以下程式內容, 資料庫接收成功

    //抓id叫做message的物件之值.val(),就是message的留言內容 
    var newMessage = $("#message").val();
    $.ajax({
      url:"{{ asset('blog-single/'.$article->id) }}",
      type: "POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },// 保護作用
      data: {
        message: newMessage
        //我自己取一個key名稱, 給一個key會給一個值:newMessage
      },

      
      success: function(response){

        Swal.fire({
          icon: 'success',
          title: '留言已新增',
          showConfirmButton: false,
          timer: 800}).then((result) => { window.location.reload(); });


        var d = new Date();
        //d.setHours(d.getHours()+8);
        var date_string = (d.getFullYear())+"-"+(d.getMonth()+1)+"-"+d.getDate();
        var hours = d.getHours();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        var time_string =  (d.getHours())+":"+(d.getMinutes())+" "+ampm;  
        

        $("#commentBox").append('<ul id="commentBox"><li><span></span><div class="info">'+newMessage+'</div><div class="name">- {{ Auth::user()->name }} -</div><div class="time"><span>'+date_string+'</span><span>'+time_string+'</span></div></li></ul>');
        //append類似c語言的 +=, 裡面的東西都要是字串(lable), 但是message是變數, 所以用+newMessage+
        //抓id叫做commentSection的物件, 他就是我的歷史留言, 我現在輸入的留言要延續歷史記錄, 所以要append
        // 我現在輸入的留言要包含: user()->id以及newMessage
        

        $("#message").val("");
      }
    });
  });
@endif

var downArrow = document.getElementById("btn1");
var upArrow = document.getElementById("btn2");

downArrow.onclick = function () {
    'use strict';
    document.getElementById("commentBox").style = "top:-620px";
    document.getElementById("commentBox").style = "top:-620px";
    downArrow.style = "display:none";
    upArrow.style = "display:block";
};

upArrow.onclick = function () {
    'use strict';
    document.getElementById("commentBox").style = "top:0";
    document.getElementById("commentBox").style = "top:80px";
    upArrow.style = "display:none";
    downArrow.style = "display:block";
};


// creating my image link

var link = document.createElement("a");
document.body.appendChild(link);

link.href = "https://codepen.io/mo7hamed/pens/public";
link.target = "_blank";

var photo = document.createElement("img");
link.appendChild(photo);

photo.src =
  "https://s3-us-west-2.amazonaws.com/s.cdpn.io/1292524/profile/profile-80.jpg";
photo.alt = "mo7amed";

photo.style =
  "border-radius:50%;position:fixed;bottom:20px;right:20px;transition:all 0.5s ease";

photo.onmouseover = function() {
  this.style.transform = "scale(1.1,1.1)";
  this.style.boxShadow = "5px 5px 15px #000";
};

photo.onmouseout = function() {
  this.style.transform = "scale(1,1)";
  this.style.boxShadow = "none";
};

</script>
@stop
