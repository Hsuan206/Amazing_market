<div class="py-1 bg-primary">
  <div class="container">
    <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
      <div class="col-lg-12 d-block">
        <div class="row d-flex">
          <div class="col-md pr-4 d-flex topper align-items-center">
            <span class="text"></span>
          </div>
          <div class="col-md pr-4 d-flex topper align-items-center">
            <span class="text"></span>
          </div>
          <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
            <span class="text"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a style="font-weight:bold;font-family:微軟正黑體;font-size:30px" class="navbar-brand" href="{{ asset('/') }}">Amazing Market</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>
    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">     
        <li class="nav-item"><a style="font-weight:bold;font-family:微軟正黑體" href="{{ asset('/blog') }}" class="nav-link">文章/食譜分享區</a></li>
        @if(Auth::check())
        <li class="nav-item dropdown">
          <a style="font-weight:bold;font-family:微軟正黑體" class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>    

          <div class="dropdown-menu" aria-labelledby="dropdown04">
            <form action="{{ asset('/blog-personal') }}" method="get">
              @csrf
              <button style="font-weight:bold;font-family:微軟正黑體" class="dropdown-item" type="submit">個人文章區</button>
            </form>
            <form action="{{ asset('/logout') }}" method="post">
              @csrf
              <button style="font-weight:bold;font-family:微軟正黑體" class="dropdown-item" type="submit">登出</button>
            </form>
          </div>
        </li>
        
        <li class="nav-item dropdown">
            <a style="font-weight:bold;font-family:微軟正黑體" class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">收藏專區</a>
            <div id="collectID" class="dropdown-menu" aria-labelledby="dropdown04">
            </div>    
        </li>    
        @else
        <li class="nav-item dropdown"><a href="{{ asset('/auth')}}" class="nav-link" >登入</a></li>
        <li class="nav-item dropdown"><a href="{{ asset('/auth/register')}}" class="nav-link" >註冊</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>

@if(Auth::check())
<script type="text/javascript">
    $(document).ready(function(){
        var userData;
        var opendataURL1 = "{{ asset('/collect/getOpenData') }}";
        var opendataJSON1;
        var jsondata1;
        var vegArray = new Array();
        //取得特定使用者收藏內容
        $.ajax({
          url: "{{ asset('/collect/getCollectionByUser')}}",
          type: "GET",
          success: function(response){
            userData = JSON.parse(response);
            console.log(userData);
            for(var i=0; i<userData.length; i++){
                $("#collectID").append('<button style="font-weight:bold;font-family:微軟正黑體" data-vgname="'+userData[i].vg_name+'" data-mrkid="'+userData[i].mrk_id+'" class="dropdown-item mycollectionBtn" type="submit">'+userData[i].vg_name+'---         '+userData[i].mrk_name+'市場</button>');
            }
          }
        });
        //獲得opendata資料
        $.ajax({
          url: opendataURL1,
          dataType: "xhr",
          type: "GET",
          async: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          error: function(error){
          console.log(JSON.parse(error.responseText));
          opendataJSON1 = JSON.parse(error.responseText);
          // Deep Copy 一份JSON
          jsondata1 = JSON.parse(JSON.stringify(opendataJSON1));
          }
        });
        //按下button後
        $(document).on("click",".mycollectionBtn",function(){
            //顯示我的收藏
            $("#mycollection").fadeIn();
            //根據按下button的id,過濾出資料
            for(var j=0;j<jsondata1.length;j++){
                console.log(jsondata1[j]["作物代號"]);
                if(jsondata1[j]["作物名稱"] == $(this).data("vgname") && jsondata1[j]["市場代號"] == $(this).data("mrkid") ){
                    console.log("123");
                    if (vegArray.includes($(this).data("vgname")+$(this).data("mrkid"))){        
                        }
                    else{
                        vegArray.push($(this).data("vgname")+$(this).data("mrkid"));
                        $("#mycollectionRow").append('<div class="cardSection"><div class="cardContainer"><i class="fas fa-heart collectBtn" title="加入收藏" data-forselectid="'+jsondata1[j]["市場代號"]+'-'+jsondata1[j]["作物代號"]+'" data-vg_id="'+jsondata1[j]["作物代號"]+'" data-mrk_id="'+jsondata1[j]["市場代號"]+'"></i><div class="card"><div class="front"><label class="marketLabel">'+jsondata1[j]["市場名稱"]+'</label><label class="frontLabel">'+jsondata1[j]["作物名稱"]+'</label></div><div class="back"><label class="backTitle">'+jsondata1[j]["作物名稱"]+'</label><br><br><table class="backContent"><tbody><tr><th>上價</th><td>'+jsondata1[j]["上價"]+'</td></tr><tr><th>中價</th><td>'+jsondata1[j]["中價"]+'</td></tr><tr><th>下價</th><td>'+jsondata1[j]["下價"]+'</td></tr><tr><th>平均價</th><td>'+jsondata1[j]["平均價"]+'</td></tr><tr><th>交易量</th><td>'+jsondata1[j]["交易量"]+'  </td></tr></tbody></table></div></div></div></div>'); 
                    }
                    }                    
                }
            });
        });
</script>
@endif

<!-- END nav -->