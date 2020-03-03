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
    /*編輯文章*/
    h4{
        text-align: center;
        color:white !important;
        font-size: 30px;
        margin: auto;
    }
    
    
    </style>
@stop
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{ asset('template/images/bg_1.jpg') }});">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	
            <h1 class="mb-0 bread" style="font-size: 60px">個人文章</h1>
          </div>
        </div>
      </div>
    </div>
    <span id="popupNotification"></span>
    <!-- Modal: modalArticle -->    
    @foreach($articles as $article)
    <section>
    <div class="modal fade" id="modalArticle{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header">
            <h4>編輯文章</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:5px;">
              <span class="update{{ $article->id }}" aria-hidden="true">×</span>
            </button>

          </div>
            <!-- 文章 post -->
<!--
            <form method="post" action="{{ url('blog-personal/'.$article->id) }}">
              @csrf
              {{ method_field('PATCH')}}
-->
              <!--Body-->
              <div class="modal-body">
                  <!-- Large outline input -->
                    <div class="md-form md-outline form-lg">
                        <input type="text" id="form-lg" class="form-control form-control-lg" placeholder="請輸入標題" name="title" value="{{ $article->title }}" disabled>
                        <br>
                    </div>
                  <textarea id="articleArea{{ $article->id }}" name="content"></textarea>
                  <!-- 作為要 post 進資料庫的圖片 URL -->
                  <input id="cache_url" type="hidden" name="cache_url" value="default">
              </div>
            
              <!--Footer-->
              <div class="modal-footer justify-content-center">
                <button id="save{{ $article->id }}" type="submit" class="btn btn-primary save" data-articleid="{{ $article->id }}" data-content="{{ $article->content }}">儲存</button>
                <button id="btn{{ $article->id }}" class="btn btn-outline-primary update{{ $article->id }}" data-dismiss="modal" data-content="{{ $article->content }}">取消</button>
              </div>
        </div>
      </div>
    </div>
    </section>
    <!-- Modal: modalDeleteArticle -->
    <div class="modal fade" id="modalDeleteArticle{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalCenterTitle">刪除文章</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:0px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            確定要刪除此篇文章嗎 ?
          </div>
          <div class="modal-footer">
            <button id="delete{{ $article->id }}" type="submit" class="btn btn-primary delete" data-articleid="{{ $article->id }}">確定</button>
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">取消</button>
          </div>
        </div>
      </div>
    </div>  
    <!-- Modal: modalDeleteArticle -->
    @endforeach
    <!-- Modal: modalArticle -->   
    

    <!-- 個人文章列表 -->
    <section class="ftco-section ftco-cart">
			<div class="container">
    			<div class="col-lg-12 ftco-animate">
                        <div class="row">
                            
                            <!-- 文章 Card 呈現 -->
                            @foreach($articles as $article)
                            <div class="col-sm-4" style="margin-bottom: 25px; height: 260px;">
                                <div class="card ftco-animate">
                                  <div class="card-body">
                                    <div class="product" style="margin-bottom:auto">
                                    <div class="text py-3 pb-4 px-3 text-center">
                                        <h5 class="card-title">{{ $article->title }}</h5>
                                        <div class="card-text" style="height: 88px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap">
                                       
                                           {!! 
                                            preg_replace('#<figure (.*?)>(.*?)</figure>#', '', $article->content); 
                                           !!}

                                        </div>
                                        <div class="bottom-area d-flex px-3">
                                            <div class="m-auto d-flex">
                                                <!-- 查看自己的貼文 -->
                                                <a href="{{ url('blog-single/'.$article->id) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                                    <span><i class="far fa-eye"></i></span>
                                                </a>
                                                <!-- 修改自己的貼文 -->
                                                <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1" data-toggle="modal" data-target="#modalArticle{{ $article->id }}">
                                                    <span><i class="fas fa-edit"></i></span>
                                                </a>
                                                <!-- 刪除自己的貼文 -->
                                                <a href="#" class="heart d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#modalDeleteArticle{{ $article->id }}">
                                                    <span><i class="far fa-trash-alt"></i></span>
                                                </a>
                                            </div>
                                          </div>
                                      </div>
                                     </div>
                                  </div>
                                    
                                  <div class="card-footer text-center">
                                    <span>{{ substr($article->created_at, 0, 10) }}</span>
                                  </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
    			</div>
    		
			</div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
		</section>
          
<!-- 個人文章列表 -->
@endsection
@section('js')
  <script>
      
        var editorinstance, img, url, parseUrl, atc_id, popupNotification;
        // 正規表達式 parse 出圖片網址
        var re = /https?:\/\/[^\s]+.(?:jpeg|jpg|gif|png|pdf|.doc)/;
              // 移除原本的樣式
        $(document).ready(function() {
          $('ul').removeClass('pagination');
          $('li').removeClass('page-item');
          $('a').removeClass('page-link');
          $('span').removeClass('page-link');
          popupNotification = $("#popupNotification").kendoNotification().data("kendoNotification");
          
        });
        
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});

        
        @foreach($articles as $article)
      
        ClassicEditor.create(document.querySelector('#articleArea{{ $article->id }}'),{
                     
        
                /* 
                    上傳圖片暫時使用 30天試用期的 CKEditor Cloud Services
                    https://ckeditor.com/ckeditor-cloud-services/easy-image/
                */
        
                    cloudServices: {
                        tokenUrl: 'https://46919.cke-cs.com/token/dev/U9uoPOtQssmRMLO2FICE3IvPIzHNQEoZc01rOaJS1PBnfCLNrq7ccBlFUeVD',
                        uploadUrl: 'https://46919.cke-cs.com/easyimage/upload/'
                    }
                })
                .then(editor => { 
                    editor.setData('{!! $article->content !!}');
            
                    // 點擊 X 或是 取消時還原editer
                    $(document).on("click",".update{{ $article->id }}",function(){
                        console.log("內容",$("#btn{{ $article->id }}").data('content'))
                        editor.setData($("#btn{{ $article->id }}").data('content'))
                    });
                    
                    // 監聽
                    editor.model.document.on( 'change:data', () => {
                        
                        console.log( '資料已更改' );
                        // 取出 editor 內容
                        editorinstance = editor.getData();
                        console.log(editorinstance);
                        document.querySelector('#save{{ $article->id }}').setAttribute('data-content', editorinstance);
                        
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
        @endforeach
        
        // 更新文章
        $(document).on("click",".save",function(){ 
            
            var id = $(this).data("articleid")
            var content = $(this).data("content")
            console.log(id);
            console.log(content);
            $.ajax({
              url: "{{ url('blog-personal') }}",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                id: id,
                content: content
              },
              type: "PATCH",
              success: function(response){
                console.log("成功");
                // modal 顯示已更新
                Swal.fire({
                  icon: 'success',
                  title: '文章已更新',
                  showConfirmButton: false,
                  timer: 800
                }).then((result) => {
                    window.location.reload();
                    });
        
                
              }
            });
          
          
        });
      
        // 刪除文章
        $(document).on("click",".delete",function(){ 
            
            var id = $(this).data("articleid")
            console.log(id);
            $.ajax({
              url: "{{ url('blog-personal') }}",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                id: id,
              },
              type: "DELETE",
              success: function(response){
                console.log("成功");
                // modal 顯示已刪除
                Swal.fire({
                  icon: 'success',
                  title: '文章已刪除',
                  showConfirmButton: false,
                  timer: 800
                }).then((result) => {
                    window.location.reload();
                    });
                 
              }
            });
          
          
        });
</script>
@stop