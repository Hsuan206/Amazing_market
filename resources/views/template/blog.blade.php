@extends('layouts.layout')
@section('title', '部落格')
@section('css')
    <style>
    /*Editer高度*/
    .ck-editor__editable_inline {
        min-height: 270px;
    }
    
    .modal-header {
        background-color: #81B13C;
       
    }
    .close {
        color:white !important;
        margin-left:0px;
    }
    .modal-footer {
        background-color: #f9f9f9;
    }
    /*取消鍵的*/
    .btn-outline-primary{
        color: #81B13C;
        border: 1px solid #81B13C;
    }
    /*新增文章*/
    h4 {
        text-align: center;
        color:white !important;
        font-size: 30px;
        margin: auto;
    }
    /*PEN STYLES*/
 .blog-card {
	 display: flex;
	 flex-direction: column;
	 margin: 1rem auto;
	 box-shadow: 0 3px 7px -1px rgba(0, 0, 0, .1);
	 margin-bottom: 1.6%;
	 background: #fff;
	 line-height: 1.4;
	 font-family: sans-serif;
	 border-radius: 5px;
	 overflow: hidden;
	 z-index: 0;
}
 .blog-card a {
	 color: inherit;
}
 .blog-card a:hover {
	 color: #81B13C;
}
 .blog-card:hover .photo {
	 transform: scale(1.3) rotate(3deg);
}
 .blog-card .meta {
	 position: relative;
	 z-index: 0;
	 height: 200px;
}
 .blog-card .photo {
	 position: absolute;
	 top: 0;
	 right: 0;
	 bottom: 0;
	 left: 0;
	 background-size: cover;
	 background-position: center;
	 transition: transform 0.2s;
}
 .blog-card .details, .blog-card .details ul {
	 margin: auto;
	 padding: 0;
	 list-style: none;
}
 .blog-card .details {
	 position: absolute;
	 top: 0;
	 bottom: 0;
	 left: -100%;
	 margin: auto;
	 transition: left 0.2s;
	 background: rgba(0, 0, 0, .6);
	 color: #fff;
	 padding: 10px;
	 width: 100%;
	 font-size: 0.9rem;
}
 .blog-card .details a {
	 text-decoration: dotted underline;
}
 .blog-card .details ul li {
	 display: inline-block;
}
 .blog-card .details .author:before {
	 font-family: FontAwesome;
	 margin-right: 10px;
	 content: "\f007";
}
 .blog-card .details .date:before {
	 font-family: FontAwesome;
	 margin-right: 10px;
	 content: "\f133";
}
 .blog-card .details .tags ul:before {
	 font-family: FontAwesome;
	 content: "\f02b";
	 margin-right: 10px;
}
 .blog-card .details .tags li {
	 margin-right: 2px;
}
 .blog-card .details .tags li:first-child {
	 margin-left: -4px;
}
 .blog-card .description {
	 padding: 1rem;
	 background: #fff;
	 position: relative;
	 z-index: 1;
}
 .blog-card .description h1 {
	 line-height: 1;
	 margin: 0;
	 font-size: 1.7rem;
}
 .blog-card .description h2 {
	 font-size: 2rem;
	 font-weight: 300;
	 text-transform: uppercase;
	 margin-top: 5px;
}
.blog-card .description h3 {
	 font-size: 1rem;
	 font-weight: 300;
	 text-transform: uppercase;
	 margin-top: 5px;
}
 .blog-card .description .read-more {
	 text-align: right;
}
 .blog-card .description .read-more a {
	 color: #ffffff;
	 display: inline-block;
	 position: relative;
}
.blog-card .description .read-more a:hover {
	 color: #81B13C;
}
 .blog-card .description .read-more a:after {
	 content: "\f061";
	 font-family: FontAwesome;
	 margin-left: -10px;
	 opacity: 0;
	 vertical-align: middle;
     color: #81B13C;
	 transition: margin 0.3s, opacity 0.3s;
}
 .blog-card .description .read-more a:hover:after {
	 margin-left: 5px;
	 opacity: 1;
}
 .blog-card p {
	 position: relative;
	 margin: 1rem 0 0;
}
 .blog-card p:first-of-type {
	 margin-top: 1.25rem;
}
 .blog-card p:first-of-type:before {
	 content: "";
	 position: absolute;
	 height: 5px;
	 background: #81B13C;
	 width: 35px;
	 top: -0.75rem;
	 border-radius: 3px;
}

 .blog-card:hover .details {
	 left: 0%;
}
 @media (min-width: 640px) {
	 .blog-card {
		 flex-direction: row;
		 max-width: 700px;
	}
	 .blog-card .meta {
		 flex-basis: 40%;
		 height: auto;
	}
	 .blog-card .description {
		 flex-basis: 60%;
	}
	 .blog-card .description:before {
		 transform: skewX(-3deg);
		 content: "";
		 background: #fff;
		 width: 30px;
		 position: absolute;
		 left: -10px;
		 top: 0;
		 bottom: 0;
		 z-index: -1;
	}
	 .blog-card.alt {
		 flex-direction: row-reverse;
	}
	 .blog-card.alt .description:before {
		 left: inherit;
		 right: -10px;
		 transform: skew(3deg);
	}
	 .blog-card.alt .details {
		 padding-left: 25px;
	}
}
     
     
    </style>
    
@stop

@section('content')


    <div class="hero-wrap hero-bread" style="background-image: url( {{ asset('template/images/bg_1.jpg') }} );">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	
            <h1 class="mb-0 bread" style="font-size:60px;">文章/食譜分享區</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal: modalArticle -->
    <!-- Modal 是什麼 ? 請自行參考 https://intersection.tw/modal-ux-6e9b2104eac0 -->
    <section>
    <div class="modal fade" id="modalArticle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header">
            <h4>新增文章</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:5px;">
              <span aria-hidden="true">×</span>
            </button>

          </div>
            <!-- 文章 post -->
              <!--Body-->
              <div class="modal-body">
                  <!-- Large outline input -->
                    <div class="md-form md-outline form-lg">
                        <input type="text" id="title" class="form-control form-control-lg" placeholder="請輸入標題" name="title" required>
                        <br>
                    </div>

                  <textarea id="articleArea" name="content"></textarea>
 
                  
                  <!-- 作為要 post 進資料庫的圖片 URL -->
                  <input id="cache_url" type="hidden" name="cache_url" value="default">
              </div>
            
              <!--Footer-->
              <div class="modal-footer justify-content-center">

                <button type="submit" class="btn btn-primary add" name="submit">確定</button>
                <button class="btn btn-outline-primary" data-dismiss="modal">取消</button>
              </div>    
        </div>
      </div>
    </div>
    </section>
    <!-- Modal: modalArticle --> 
      
      
    <!-- 文章列表 -->
    <section class="ftco-section ftco-degree-bg">
      <div class="container">
          <div class="col-lg-12 ftco-animate">
                <div class="row"  style="margin-bottom:30px">
                    <div class="col-md-1"></div>
                    <div class="col-md-11 d-flex ftco-animate">
                      <!-- 觸發 modal-->
                      <!-- data-target 根據 element ID 觸發 -->
                      <button id="addArticle" type="button" class="btn btn-primary" data-toggle="modal">  
                          <i class='fas fa-plus justify-content-center align-items-center'></i>
                      </button>
                    </div>
                </div>
            </div>
            
          <!-- 文章顯示 -->
          <!-- 這裡的 articles 就是從 controller 傳過來的 -->
          <!-- 假設改成foreach($arts as $art) -->
          <!-- $arts由template.blog中傳入, 代表整個頁面中的所有食譜 -->
          <!-- $art由template.blog中傳入, 代表整個頁面中的其中一項食譜 -->
          @foreach($articles as $article)
              
              
              @php
              # 判斷欄位是否有圖片
              if(strpos($article->img_url,'http')!==False){
                    $img = $article->img_url;
              } else {
                    $img = asset('template/images/recipe.png');
              }
              @endphp
            <div class="col-lg-12 ftco-animate">
                <div class="blog-card">
                    <div class="meta">
                      <div class="photo" style="background-image: url('{{ $img }}')"></div>
                      <ul class="details">
                        <li class="author">{{ \App\User::where('id', $article->user_id)->value('name') }}</li>
                        <li class="date">{{ substr($article->created_at, 0, 10) }}</li>
<!--
                        <li class="tags">
                          <ul>
                            <li><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></li>
                          </ul>
                        </li>
-->
                      </ul>
                    </div>
                    <div class="description">
                      <h1><a href="{{ url('blog-single/'.$article->id) }}">{{ $article->title }}</a></h1>
                        <div class="show-article" style="height: 130px; overflow: hidden; margin-bottom: 10px; margin-top: 10px">                        
                          <!-- 使用!!以下程式會將 text 自動跳脫出字串型態 -->
                        <!-- 不將圖片顯示在列表：preg_replace 將 figure tag 以空字串取代 -->
                        {!! 

                            $article->content = preg_replace('#<figure (.*?)>(.*?)</figure>#', '', $article->content); 
                        !!}
                        <!-- 單項食譜$art的content表格 -->

                        </div>  
                    <!-- 點擊 查看更多 去取得某指定文章 id 的文章 -->
                    <p><a href="{{ url('blog-single/'.$article->id) }}" class="btn btn-primary py-2 px-3">查看更多</a></p>
                    <!-- 單項食譜$art的id表格 -->
                  </div>
                </div>
          </div>

          @endforeach

        </div>
          <!-- Pagination 分頁 -->
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <!-- 會自動產生分頁的連結，laravel 會幫你管理分頁的程式碼 -->
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
            
    </section> 



@endsection
@section('js')
<script> 
    // 移除原本分頁的樣式
    $(document).ready(function() {
      $('ul').removeClass('pagination');
      $('li').removeClass('page-item');
      $('a').removeClass('page-link');
      $('span').removeClass('page-link');
        
    });
    
    @if(Auth::check())
    document.querySelector('#addArticle').setAttribute('data-target', "#modalArticle");
    @endif
    
    
    let editorinstance, img, url, parseUrl;
    // 正規表達式 parse 出圖片網址
    let re = /https?:\/\/[^\s]+.(?:jpeg|jpg|gif|png|pdf|.doc)/;
    ClassicEditor.create(document.querySelector('#articleArea'),{
        
                /* 
                    上傳圖片暫時使用 30天試用期的 CKEditor Cloud Services
                    https://ckeditor.com/ckeditor-cloud-services/easy-image/
                */
        
                    cloudServices: {
                        tokenUrl: 'https://46919.cke-cs.com/token/dev/U9uoPOtQssmRMLO2FICE3IvPIzHNQEoZc01rOaJS1PBnfCLNrq7ccBlFUeVD',
                        uploadUrl: 'https://46919.cke-cs.com/easyimage/upload/'
                       
                    },
//                    simpleUpload:{
//                        uploadUrl: "http://ec2-34-209-123-120.us-west-2.compute.amazonaws.com/miswhatever/public/"
//                    },
//                    headers: {
//                        'X-CSRF-TOKEN': 'CSFR-Token'
//                    }
                })
                .then(editor => { 
                    document.querySelector("input[class='ck-hidden']").setAttribute('name', 'image');

                    // 監聽
                    editor.model.document.on( 'change:data', () => {
                        
                        console.log( '資料已更改' );
                        // 取出 editor 內容
                        editorinstance = editor.getData();
                        console.log(editorinstance);
                        
                        // 找出符合正規表達式的字串
                        parseUrl = editorinstance.match(re);
                        
                        // 輸出為陣列，parseUrl[0] 為符合的字串
                        url = parseUrl && parseUrl[0];
                        
                        // 只需要 https .. 
                        console.log(url)
                        // 將 input 的 value 設為 URL 等待被送進 DB
                        if(url!=null){
                            document.querySelector('#cache_url').setAttribute('value', url);
                        }
                        
                    })
     
                })
                .catch(error => { 
                    console.error(error); 
                    }); 
    

    $(document).on("click","#addArticle",function(){ 
        @if(Auth::check())
        @else
            Swal.fire({
              icon: 'error',
              title: '沒有權限',
              text: '請登入進行新增',
              confirmButtonColor: '#81B13C',
              confirmButtonText: '登入',
              showCloseButton: true,
              footer: '<a href="{{ asset('/auth/register') }}">還沒有帳號嗎?</a>'
            }).then((result) => {
                  console.log(result.value)
                  if (result.value) {
                    window.location.assign("{{ asset('/auth') }}");
                  }
                })
//                
        @endif
    });
    
    // 新增文章
    $(document).on("click",".add",function(){ 
        
        // 判斷標題或是內容是否為空
        if($('#title').val()=='') {
            Swal.fire({
              icon: 'info',
              title: '請輸入標題',
              showConfirmButton: true,
              showCloseButton: true,
              confirmButtonText: '確定',
                
            });
        }else if(editorinstance==null || editorinstance=='') {
            Swal.fire({
              icon: 'info',
              title: '請輸入文章內容',
              showConfirmButton: true,
              showCloseButton: true,
              confirmButtonText: '確定'
            });   
                
        }else{
            
            $.ajax({
              url: "{{ url('blog') }}",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                title: $('#title').val(),
                content: editorinstance,
                cache_url: $('#cache_url').attr('value')
              },
              type: "POST",
              success: function(response){
                console.log("成功");
                // modal 顯示已新增
                Swal.fire({
                  icon: 'success',
                  title: '文章已新增',
                  showConfirmButton: false,
                  timer: 800
                }).then((result) => {
                    window.location.reload();
                    });


              }
            });  
        }
        

    });
    
</script>
@stop
