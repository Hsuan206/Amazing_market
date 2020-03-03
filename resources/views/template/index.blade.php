@extends('layouts.layout')
@section('title', '妙花種子')
@section('css')
<link href="{{ asset('/search/css/main.css') }}" rel="stylesheet" />
<style type="text/css">
   * {
        font-family: 微軟正黑體;
    }
  // LOADING 
  #loadingContainer {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
    text-align: center;
  }
  #loadingContainer ul {
    margin-left: 40%;
    display: flex;
    width: 100%;
    text-align: center;
  }
  #loadingContainer ul li {
    width: 20px;
    height: 20px;
    margin: 10px;
    list-style-type: none;
    transition: 0.5s all ease;
    display: inline-block;
  }
  #loadingContainer ul li:nth-child(1) {
    animation: right-1 1s infinite alternate;
    background-color: #DDD8B8;
    animation-delay: 100ms;
  }
  @keyframes right-1 {
    0% {
      transform: translateY(-60px);
    }
    100% {
      transform: translateY(60px);
    }
  }
  #loadingContainer ul li:nth-child(2) {
    animation: right-2 1s infinite alternate;
    background-color: #B3CBB9;
    animation-delay: 200ms;
  }
  @keyframes right-2 {
    0% {
      transform: translateY(-70px);
    }
    100% {
      transform: translateY(70px);
    }
  }
  #loadingContainer ul li:nth-child(3) {
    animation: right-3 1s infinite alternate;
    background-color: #84A9C0;
    animation-delay: 300ms;
  }
  @keyframes right-3 {
    0% {
      transform: translateY(-80px);
    }
    100% {
      transform: translateY(80px);
    }
  }
  #loadingContainer ul li:nth-child(4) {
    animation: right-4 1s infinite alternate;
    background-color: #6A66A3;
    animation-delay: 400ms;
  }
  @keyframes right-4 {
    0% {
      transform: translateY(-90px);
    }
    100% {
      transform: translateY(90px);
    }
  }
  #loadingContainer ul li:nth-child(5) {
    animation: right-5 1s infinite alternate;
    background-color: #58548E;
    animation-delay: 500ms;
  }
  @keyframes right-5 {
    0% {
      transform: translateY(-100px);
    }
    100% {
      transform: translateY(100px);
    }
  }

  .product label{
    cursor: pointer;
  }
  .product:hover{
    background-color: #EEFFBB;
  }
  .collectBtn{
    position: absolute;
    bottom: 10px;
    right: 10px;
    z-index: 1;
    cursor: pointer;
    transition: 0.3s;
    font-size:24px;
    color: #FF8888;
  }
  .collectBtn:hover{
    color: #FF0000;
    font-size: 35px;
  }
  .vegetableModalHeader{
    font-size: 30px;
  }
  /* Card */
  .cardSection{
    display: inline-block;
    padding: 5px;
  }
  .cardContainer{
    width: 300px;
    height: 200px;
    position: relative;  
    perspective: 800px;
    border-radius: 4px;
    display: inline-block;
  }
  .card {
    width: 100%;
    height: 100%;
    position: absolute;
    -webkit-transform-style: preserve-3d;
    transform-style: preserve-3d;
    transition: -webkit-transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275), -webkit-transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border-radius: 6px;
    border-width: 5px;
    border-color: #66CDAA;
    box-shadow: 0px 5px 20px -10px #3A1C71;
    /*box-shadow: 0 6px 16px rgba(0,0,0,0.15);*/
    cursor: pointer;
  }
  .card div {
    position: absolute;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    border-radius: 6px;
    background: #fff;
    /*background: transparent;*/
    display: -ms-flexbox;
    display: box;
    display: flex;
    -o-box-pack: center;
    justify-content: center;
    -o-box-align: center;
    align-items: center;
    font: 16px/1.5 "Helvetica Neue", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    color: #47525d;
  }
  .card .back {
    -webkit-transform: rotateY(180deg);
    transform: rotateY(180deg);
  }
  .card.flipped {
    -webkit-transform: rotateY(180deg);
    transform: rotateY(180deg);
    background-color: transparent;
  }
  .marketLabel{
    font-size: 14px;
    position: absolute;
    top: 0px;
    left: 0px;
  }
  .frontLabel{
    font-size: 35px;
  }
  .backTitle{
    position: absolute;
    top:2%;
    font-size: 25px;
  }
  .backContent {
    margin: 1em 2em 0 2em;
    width: 100%;
  }
  .backContent th {
    font-family: "Open Sans Condensed", "Open Sans", helvetica, sans-serif;
    text-align: right;
    font-weight: 300;
    width: 50%;
  }  
  .backContent th, td {
    width: 50%;
    padding: 0.01em 0.25em 0.1em 0.3em;
  }
  ::-webkit-scrollbar {
    -webkit-appearance: none;
    width: 3px;
    height: 10px;
  }
  ::-webkit-scrollbar-thumb {
    border-radius: 2px;
    background-color: rgba(0,0,0,.5);
    -webkit-box-shadow: 0 0 1px rgba(255,255,255,.5);
  }
</style>
@stop
@section('content')
<section class="ftco-section" style="text-align: center; line-height: 2;">
  <div class="searchDiv">
    <form>
      <div class="inner-form">
        <div class="input-field first-wrap">
          <div class="icon-wrap">
            <i class="fa fa-search"></i>
          </div>
          <input id="search" type="text" placeholder="在找什麼作物？" value="" />
        </div>
        <!-- <div class="input-field second-wrap">
          <div class="icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z">
              </path>
            </svg>
          </div>
          <input class="datepicker" id="depart" type="text" placeholder="29 Aug 2018" />
        </div> -->
        <div class="input-field fouth-wrap">
          <div class="icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
            </svg>
          </div>
          <select data-trigger="" name="choices-single-defaul" id="marketSelector">
            <option value="all" selected>所有市場</option>
          </select>
        </div>
        <div class="input-field fifth-wrap">
          <button class="btn-search" type="button" id="vegetableSearchBtn">查詢</button>
        </div>
        <div class="input-field sixth-wrap">
          <button class="btn-refresh" id="refreshBtn" type="button"><i class="fa fa-refresh"></i></button>
        </div>
      </div>
    </form>
  </div>
  <div class="container">
    <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ftco-animate">
        <span class="subheading" id="timeHead"></span>
        <h2 style="font-family:微軟正黑體" id="mycollection" class="mb-4">我的收藏</h2>
          <div id="mycollectionRow"></div>  
        <h2 style="font-family:微軟正黑體" class="mb-4">農產品</h2>
      </div>
    </div>      
  </div>
  <div id="loadingContainer">
      <ul>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
  <div id="vegetableRow" style="margin: 20px;">

  </div>
  <!-- End of Row -->
</section>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    //先隱藏我的收藏  
    $("#mycollection").hide();  
    // 判定是否已經有資料
    var getRemoteData = false;
    var d = new Date();
    var month = d.getMonth()+1;
    var date = d.getUTCDate();
    $("#timeHead").html(month + "/" + date);
    var opendataURL = "{{ asset('/collect/getOpenData') }}";
    var opendataJSON;
    var opendataJSON_Kendo;
    var marketOption = [];
    var vegetableOption = [];
    var jsonData;
    var userCollectionData;
    // 已經顯示過的就跳過
    var jsonCount = 0;
    // 獲得特定使用者已經收藏的資料
    $.ajax({
      url: "{{ asset('/collect/getCollectionByUser')}}",
      type: "GET",
      async: false,
      success: function(response){
        userCollectionData = JSON.parse(response);
      }
    });
    $.ajax({
      url: opendataURL,
      dataType: "xhr",
      type: "GET",
      async: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      // success: function(response){
      //   console.log("123213213");
      //   opendataJSON = JSON.parse(error.responseText);
      //   getRemoteData = true;
      //   // 將回傳的JSON變成全域變數
      //   opendataJSON_Kendo = new kendo.data.DataSource(opendataJSON);
      //   // 隱藏載入動畫
      //   $("#loadingContainer").hide();
      //   uploadData_JSON();

      // },
      // 因為回傳的不是JSON，所以會觸發error
      error: function(error){
        console.log(JSON.parse(error.responseText));
        opendataJSON = JSON.parse(error.responseText);
        // Deep Copy 一份JSON
        jsonData = JSON.parse(JSON.stringify(opendataJSON));
        getRemoteData = true;
        // 隱藏載入動畫
        $("#loadingContainer").hide();
        uploadData_JSON();
        // 整理出所有可用的市場選項&作物選項
        for (var i = 0; i<opendataJSON.length; i++) {
          // 市場
          if(!marketOption.includes(opendataJSON[i]["市場名稱"])){
              marketOption.push(opendataJSON[i]["市場名稱"]);
          }
          // 作物
          if(!vegetableOption.includes(opendataJSON[i]["市場名稱"])){
            vegetableOption.push(opendataJSON[i]["作物名稱"]);
          }
        }
        // 放入市場選項
        for(var i = 0; i<marketOption.length; i++){
          $("#marketSelector").append('<option value="'+marketOption[i]+'">'+marketOption[i]+'</option>');
        }
        const choices = new Choices('[data-trigger]',
        {
          searchEnabled: false,
          shouldSort: false,
          itemSelectText: '',
        });
        // 放入作物選項
      }
    });
    // 將JSON資料放入頁面上
    function uploadData_JSON(){
      $("#vegetableRow").html("");
      jsonCount = 0;
      // 一次放十二個，若是小於12的就全放上去
      var putCount = 12;
      if(jsonData.length<12){
        putCount = jsonData.length;
      }
      // 先放十二個
      for (var i = 0; i < putCount; i++) {
        @if(Auth::check())
        var checkIfExist = false;
        for(var j = 0; j < userCollectionData.length; j++){
          var compare_user = userCollectionData[j].mrk_id+"-"+userCollectionData[j].vg_id;
          var compare_opendata = jsonData[i]["市場代號"]+"-"+jsonData[i]["作物代號"];
          if(compare_user == compare_opendata){
            checkIfExist = true;
            userCollectionData.splice(j-1, 1);
            break;
          }
        }
        // 若使用者已經有了
        if(checkIfExist){
          $("#vegetableRow").append('<div class="cardSection"><div class="cardContainer"><i class="fas fa-heart collectBtn" title="加入收藏" data-forselectid="'+jsonData[i]["市場代號"]+'-'+jsonData[i]["作物代號"]+'" data-vg_id="'+jsonData[i]["作物代號"]+'" data-vg_name="'+jsonData[jsonCount]["作物名稱"]+'" data-mrk_id="'+jsonData[i]["市場代號"]+'" data-mrk_name="'+jsonData[i]["市場名稱"]+'"></i><div class="card"><div class="front"><label class="marketLabel">'+jsonData[i]["市場名稱"]+'</label><label class="frontLabel">'+jsonData[i]["作物名稱"]+'</label></div><div class="back"><label class="backTitle">'+jsonData[i]["作物名稱"]+'</label><br><br><table class="backContent"><tbody><tr><th>上價</th><td>'+jsonData[i]["上價"]+'</td></tr><tr><th>中價</th><td>'+jsonData[i]["中價"]+'</td></tr><tr><th>下價</th><td>'+jsonData[i]["下價"]+'</td></tr><tr><th>平均價</th><td>'+jsonData[i]["平均價"]+'</td></tr><tr><th>交易量</th><td>'+jsonData[i]["交易量"]+'  </td></tr></tbody></table></div></div></div></div>');
        }else{
          @endif
          $("#vegetableRow").append('<div class="cardSection"><div class="cardContainer"><i class="far fa-heart collectBtn" title="加入收藏" data-forselectid="'+jsonData[i]["市場代號"]+'-'+jsonData[i]["作物代號"]+'" data-vg_id="'+jsonData[i]["作物代號"]+'" data-vg_name="'+jsonData[jsonCount]["作物名稱"]+'" data-mrk_id="'+jsonData[i]["市場代號"]+'" data-mrk_name="'+jsonData[i]["市場名稱"]+'"></i><div class="card"><div class="front"><label class="marketLabel">'+jsonData[i]["市場名稱"]+'</label><label class="frontLabel">'+jsonData[i]["作物名稱"]+'</label></div><div class="back"><label class="backTitle">'+jsonData[i]["作物名稱"]+'</label><br><br><table class="backContent"><tbody><tr><th>上價</th><td>'+jsonData[i]["上價"]+'</td></tr><tr><th>中價</th><td>'+jsonData[i]["中價"]+'</td></tr><tr><th>下價</th><td>'+jsonData[i]["下價"]+'</td></tr><tr><th>平均價</th><td>'+jsonData[i]["平均價"]+'</td></tr><tr><th>交易量</th><td>'+jsonData[i]["交易量"]+'  </td></tr></tbody></table></div></div></div></div>');

        @if(Auth::check())
        }
        @endif
        // 已經放上去的就先移除
        jsonCount++;
      }
    }
    // 透過Kendo將過濾過的資料放入頁面上
    function uploadData_Kendo(json){
      
    }

    // 滾到下方時載入更多資料
    $(window).scroll(function() {
      var height = $(document).height()*0.55;
      if($(window).scrollTop() >= height) {
        // 確定已經有資料了才執行、確定還沒放完
        var checkDone = (jsonData.length - jsonCount > 0);
        if(getRemoteData && checkDone){
          var itemCount = 12;
          console.log(jsonData.length);
          console.log(jsonCount);
          if((jsonData.length - jsonCount)<12){
            itemCount = (jsonData.length - jsonCount);
          }
          console.log(itemCount);
          // 一次放十二個
          if(itemCount>0){
            for (var i = 0; i < itemCount; i++) {
              console.log(jsonData);
              @if(Auth::check())
              var checkIfExist = false;
              for(var j = 0; j < userCollectionData.length; j++){
                var compare_user = userCollectionData[j].mrk_id+"-"+userCollectionData[j].vg_id;
                var compare_opendata = jsonData[jsonCount]["市場代號"]+"-"+jsonData[jsonCount]["作物代號"];
                console.log("USER: "+compare_user);
                console.log("OPENDATA: "+compare_opendata);
                if(compare_user == compare_opendata){
                  checkIfExist = true;
                  userCollectionData.splice(j-1, 1);
                  break;
                }
              }
              // 若使用者已經有了
              if(checkIfExist){
                $("#vegetableRow").append('<div class="cardSection"><div class="cardContainer"><i class="fas fa-heart collectBtn" title="加入收藏" data-forselectid="'+jsonData[jsonCount]["市場代號"]+'-'+jsonData[jsonCount]["作物代號"]+'" data-vg_id="'+jsonData[jsonCount]["作物代號"]+'" data-vg_name="'+jsonData[jsonCount]["作物名稱"]+'" data-mrk_id="'+jsonData[jsonCount]["市場代號"]+'" data-mrk_name="'+jsonData[i]["市場名稱"]+'"></i><div class="card"><div class="front"><label class="marketLabel">'+jsonData[jsonCount]["市場名稱"]+'</label><label class="frontLabel">'+jsonData[jsonCount]["作物名稱"]+'</label></div><div class="back"><label class="backTitle">'+jsonData[jsonCount]["作物名稱"]+'</label><br><br><table class="backContent"><tbody><tr><th>上價</th><td>'+jsonData[jsonCount]["上價"]+'</td></tr><tr><th>中價</th><td>'+jsonData[jsonCount]["中價"]+'</td></tr><tr><th>下價</th><td>'+jsonData[jsonCount]["下價"]+'</td></tr><tr><th>平均價</th><td>'+jsonData[jsonCount]["平均價"]+'</td></tr><tr><th>交易量</th><td>'+jsonData[jsonCount]["交易量"]+'  </td></tr></tbody></table></div></div></div></div>');
              }else{
                @endif
                $("#vegetableRow").append('<div class="cardSection"><div class="cardContainer"><i class="far fa-heart collectBtn" title="加入收藏" data-forselectid="'+jsonData[jsonCount]["市場代號"]+'-'+jsonData[jsonCount]["作物代號"]+'" data-vg_id="'+jsonData[jsonCount]["作物代號"]+'" data-vg_name="'+jsonData[jsonCount]["作物名稱"]+'" data-mrk_id="'+jsonData[jsonCount]["市場代號"]+'" data-mrk_name="'+jsonData[i]["市場名稱"]+'"></i><div class="card"><div class="front"><label class="marketLabel">'+jsonData[jsonCount]["市場名稱"]+'</label><label class="frontLabel">'+jsonData[jsonCount]["作物名稱"]+'</label></div><div class="back"><label class="backTitle">'+jsonData[jsonCount]["作物名稱"]+'</label><br><br><table class="backContent"><tbody><tr><th>上價</th><td>'+jsonData[jsonCount]["上價"]+'</td></tr><tr><th>中價</th><td>'+jsonData[jsonCount]["中價"]+'</td></tr><tr><th>下價</th><td>'+jsonData[jsonCount]["下價"]+'</td></tr><tr><th>平均價</th><td>'+jsonData[jsonCount]["平均價"]+'</td></tr><tr><th>交易量</th><td>'+jsonData[jsonCount]["交易量"]+'  </td></tr></tbody></table></div></div></div></div>');
              @if(Auth::check())
              }
              @endif
              // 已經放上去的就先移除
              jsonData.splice(i-1, 1);
              jsonCount++;
            }
          }
        }
      }
    });
    // 加入收藏
    $(document).on("click",".collectBtn",function(){ 
      @if(Auth::check())
      var collectBtn = $(this);
      if(collectBtn.hasClass("far")){
        // 尚未被收藏，執行被收藏
        $.ajax({
          url: "{{ asset('/collect/create')}}",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            vg_id : collectBtn.data("vg_id"), 
            vg_name : collectBtn.data("vg_name"),
            mrk_id : collectBtn.data("mrk_id"),
            mrk_name: collectBtn.data("mrk_name")
          },
          type: "POST",
          success: function(response){
            console.log(response);
            // 收藏按鈕樣式變化
            collectBtn.toggleClass("far");
            collectBtn.toggleClass("fas");
            $("#collectID").append('<button style="font-weight:bold;font-family:微軟正黑體" data-vgname="'+collectBtn.data("vg_name")+'" data-mrkid="'+collectBtn.data("mrk_id")+'" class="dropdown-item mycollectionBtn" type="submit">'+collectBtn.data("vg_name")+'---         '+collectBtn.data("mrk_name")+'市場</button>');
          }
        });
      }else if ($(this).hasClass("fas")){
        // 已經被收藏，執行移除收藏
        $.ajax({
          url: "{{ asset('/collect/delete')}}",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            vg_id : collectBtn.data("vg_id"),
            vg_name : collectBtn.data("vg_name"),  
            mrk_id : collectBtn.data("mrk_id"),
            mrk_name: collectBtn.data("mrk_name")
          },
          type: "POST",
          success: function(response){
            console.log(response);
            // 收藏按鈕樣式變化
            collectBtn.toggleClass("far");
            collectBtn.toggleClass("fas");
          }
        });
      }
      @else
        window.location.assign("{{ asset('/auth') }}");
      @endif
    });


    // 重整
    $(document).on("click","#refreshBtn",function(){
      // 用完整的資料去重整
      $("#vegetableRow").html("");
      jsonData = opendataJSON;
      uploadData_JSON();
    });

    // 查詢
    $(document).on("click","#vegetableSearchBtn",function(){
      $("#vegetableRow").html("");
      // Deep Copy一份JSON去搜尋
      jsonData = JSON.parse(JSON.stringify(opendataJSON));
      console.log(jsonData);
      var targetMarket = $("#marketSelector").val();
      var targetVegetable = $("#search").val();
      console.log(targetMarket+" / "+targetVegetable);
      var result = [];
      if(targetMarket == "all"){
        // 無特定市場
        if(targetVegetable != ""){
          // 有特定作物
          for(var i =0; i<jsonData.length; i++){
            if(jsonData[i]["作物名稱"].indexOf(targetVegetable) >= 0){
              result.push(jsonData[i]);
            }
          }
        }else{
          // 無特定作物
          result = jsonData;
        }
      }else{
        // 有特定市場
        if(targetVegetable != ""){
          // 有特定作物
          for(var i =0; i<jsonData.length; i++){
            if(jsonData[i]["作物名稱"].indexOf(targetVegetable) >= 0 && jsonData[i]["市場名稱"].indexOf(targetMarket) >= 0){
              result.push(jsonData[i]);
            }
          }
        }else{
          // 無特定作物
          for(var i =0; i<jsonData.length; i++){
            if(jsonData[i]["市場名稱"].match(targetMarket) != null){
              result.push(jsonData[i]);
            }
          }
        }
      }
      jsonData = JSON.parse(JSON.stringify(result));
      uploadData_JSON();
    });
  });
  // End Document Ready
  // Card的翻動動畫
  $(document).on('click','.card', function () {
    $(this).toggleClass('flipped');
  });
</script>
<script src="{{ asset('/search/js/extention/choices.js') }}"></script>
<script src="{{ asset('/search/js/extention/flatpickr.js') }}"></script>
<script>
  flatpickr(".datepicker",
  {});
</script>
@stop