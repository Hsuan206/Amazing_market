@extends('layouts.layout')
@section('title', '幻燈片管理')
@section('css')
<style type="text/css">
	.slider {
	  position: relative;
	  width: 100%;
	  height: 500px;
	  overflow: hidden;
	  margin: 0;
	  padding: 0;
	}

	.slides {
	  height: 100%;
	  /* Clear fix */
	  overflow: hidden;
	  *zoom: 1;
	  /**
	   * Prevent blinking issue
	   * Not tested. Experimental.
	   */
	  -webkit-backface-visibility: hidden;
	  -webkit-transform-style: preserve-3d;
	  margin: 0;
	  padding: 0;
	}

	.slide {
	  list-style: none;
	  height: 100%;
	  float: left;
	  clear: none;
	  background-size: no-repeat;
	}

	.slider-arrow {
	  position: absolute;
	  display: block;
	  margin-bottom: -20px;
	  padding: 0;
	}

	.slider-arrow--right {
	  bottom: 50%;
	  right: 20px;
	  width: 0px;
	  height: 0px;
	  border-style: solid;
	  border-width: 10px 0 10px 10px;
	  border-color: transparent transparent transparent #ffffff;
	}

	.slider-arrow--left {
	  bottom: 50%;
	  left: 20px;
	  width: 0px;
	  height: 0px;
	  border-style: solid;
	  border-width: 10px 10px 10px 0;
	  border-color: transparent #ffffff transparent transparent;
	}

	.slider-nav {
	  position: absolute;
	  bottom: 40px;
	}

	.slider-nav__item {
	  width: 10px;
	  height: 10px;
	  float: left;
	  clear: none;
	  display: block;
	  margin: 0 8px;
	  background: #fff;
	}

	.slider-nav__item:hover {
	  background: #00FF7F	;
	}

	.slider-nav__item--current {
	  background: #00FF7F	;
	}

	.drop {
	  animation: drop .5s ease forwards;
	}

	@keyframes drop {
	  0%   { transform: translateY(-60px); opacity: 0; }
	  100% { transform: translateY(0); opacity: 1; }
	}

	.slide-text {
	  position: relative;
	  opacity: 0;
	  top: 80%;
	  right: 20%;
	  margin-top: -25px;
	  font-size: 3em;
	  text-align: center;
	  color: lightcyan;
	  text-shadow: 1px 1px 0 dimgrey, 2px 2px 0 dimgrey, 3px 3px 0 dimgrey, 4px 4px 0 dimgrey, 5px 5px 0 dimgrey;
	}

	/*Control Panel*/
	.controlPanel{
		text-align: center;
		padding: 20px;
	}
	.buttonSection{
		width: 100%;
		display: inline;
		position: relative;
		text-align: center;
	}
	.addBtn{
		width: 20%;
		height: 50px;
		cursor: pointer;
		border-radius: 10px;
		background-color: #3CB371;
		transition: 0.3s;
	}
	.addBtn:hover{
		width: 22%;
		background-color: #66CDAA;
	}
	.removeBtn{
		width: 20%;
		height: 50px;
		cursor: pointer;
		border-radius: 10px;
		background-color: #FF4500;
		transition: 0.3s;
	}
	.removeBtn:hover{
		width: 22%;
		background-color: #FF6347;
	}
	/*input*/
	.inp {
	  position: relative;
	  margin: auto;
	  width: 90%;
	}
	.inp .label {
	  position: absolute;
	  top: 16px;
	  left: 0;
	  font-size: 16px;
	  color: #9098a9;
	  font-weight: 500;
	  transform-origin: 0 0;
	  transition: all 0.2s ease;
	}
	.inp .border {
	  position: absolute;
	  bottom: 0;
	  left: 0;
	  height: 2px;
	  width: 100%;
	  background: #07f;
	  transform: scaleX(0);
	  transform-origin: 0 0;
	  transition: all 0.15s ease;
	}
	.inp input {
	  -webkit-appearance: none;
	  width: 100%;
	  border: 0;
	  font-family: inherit;
	  padding: 12px 0;
	  height: 48px;
	  font-size: 16px;
	  font-weight: 500;
	  border-bottom: 2px solid #c8ccd4;
	  background: none;
	  border-radius: 0;
	  color: #223254;
	  transition: all 0.15s ease;
	}
	.inp input:hover {
	  background: rgba(34,50,84,0.03);
	}
	.inp input:not(:placeholder-shown) + span {
	  color: #5a667f;
	  transform: translateY(-26px) scale(0.75);
	}
	.inp input:focus {
	  background: none;
	  outline: none;
	}
	.inp input:focus + span {
	  color: #07f;
	  transform: translateY(-26px) scale(0.75);
	}
	.inp input:focus + span + .border {
	  transform: scaleX(1);
	}
	/*圖片上傳*/
	.file-upload {
	  background-color: #ffffff;
	  width: 100%;
	  margin: 0 auto;
	  padding: 20px;
	}
	.file-upload-btn {
	  width: 100%;
	  margin: 0;
	  color: #fff;
	  background: #1FB264;
	  border: none;
	  padding: 10px;
	  border-radius: 4px;
	  border-bottom: 4px solid #15824B;
	  transition: all .2s ease;
	  outline: none;
	  text-transform: uppercase;
	  font-weight: 700;
	}

	.file-upload-btn:hover {
	  background: #1AA059;
	  color: #ffffff;
	  transition: all .2s ease;
	  cursor: pointer;
	}

	.file-upload-btn:active {
	  border: 0;
	  transition: all .2s ease;
	}

	.file-upload-content {
	  display: none;
	  text-align: center;
	}

	.file-upload-input {
	  position: absolute;
	  margin: 0;
	  padding: 0;
	  width: 100%;
	  height: 100%;
	  outline: none;
	  opacity: 0;
	  cursor: pointer;
	}

	.image-upload-wrap {
	  margin-top: 20px;
	  border: 4px dashed #1FB264;
	  position: relative;
	  transition: 0.3s;
	}

	.image-dropping,
	.image-upload-wrap:hover {
	  background-color: #1FB264;
	  border: 4px dashed #ffffff;
	}

	.image-title-wrap {
	  padding: 0 15px 15px 15px;
	  color: #222;
	  font-size: 15px;
	}

	.drag-text {
	  text-align: center;
	}
	.drag-text label {
	  font-weight: 100;
	  text-transform: uppercase;
	  color: #15824B;
	  font-size: 25px;
	  padding: 60px 0;
	  transition: 0.3s;
	}

	.file-upload-image {
	  max-height: 400px;
	  max-width: 100%;
	  margin: auto;
	  padding: 20px;
	}

	.remove-image {
	  width: 200px;
	  margin: 0;
	  color: #fff;
	  background: #cd4535;
	  border: none;
	  padding: 10px;
	  border-radius: 4px;
	  border-bottom: 4px solid #b02818;
	  transition: all .2s ease;
	  outline: none;
	  text-transform: uppercase;
	  font-weight: 700;
	}

	.remove-image:hover {
	  background: #c13b2a;
	  color: #ffffff;
	  transition: all .2s ease;
	  cursor: pointer;
	}

	.remove-image:active {
	  border: 0;
	  transition: all .2s ease;
	}
	/* Delete Modal */
	.deleteGallery{
		width: 100%;
		overflow-x: auto;
		white-space: nowrap;
	}
	.deleteImgContainer{
		width: 100px;
		height: 100px;
		display: inline;
	}
	.deleteImgContainer img{
		height: 100%;
   		width: 100%;
		background-size: cover;
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
<div class="slider">
  	<ul class="slides">
  		@foreach($carousels as $carousel)
	    	<li class="slide" style="background-image: url('{{ asset('carousel_Img/'.$carousel->img_url) }}');"><p class="slide-text">{{ $carousel->title }}</p></li>
	    @endforeach
  	</ul>
</div>

<div class="controlPanel">
	<div class="buttonSection">
		<button class="addBtn" data-toggle="modal" data-target="#createCarouselModal"><i class='fas fa-plus' style='font-size:36px'></i></button>
	</div>
	<div class="buttonSection">
		<button class="removeBtn" data-toggle="modal" data-target="#deleteCarouselModal"><i class='fas fa-times' style='font-size:36px'></i></button>
	</div>
</div>

<!-- Modal Section -->
<!-- Create Modal -->
<div id="createCarouselModal" class="modal fade" role="dialog">
 	<div class="modal-dialog">
		<!-- Modal content-->
    	<div class="modal-content">
      		<form action="{{ asset('/carousel/create') }}" method="post"  enctype="multipart/form-data">
      			@csrf
	      		<div class="modal-header">
	        		<h4 class="modal-title">新增幻燈片</h4>
	      		</div>
	      		<!-- Modal Body -->
	      		<div class="modal-body" style="text-align: center;">
	      			<!-- 標題 -->
	      			<label for="titleInput" class="inp">
					  	<input type="text" id="titleInput" name="title" placeholder="&nbsp;" required="請輸入標題">
					  	<span class="label">標題</span>
					  	<span class="border"></span>
					</label>
					<br><br>
					<!-- 註記 -->
					<label for="hintInput" class="inp">
					  	<input type="text" id="hintInput" name="hint" placeholder="&nbsp;">
					  	<span class="label">註記(選填)</span>
					  	<span class="border"></span>
					</label>
					<!-- 圖片 -->
					<div class="file-upload">
					  	<div class="image-upload-wrap">
					    	<input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="img" required="請選擇一張圖片" />
					    	<div class="drag-text">
					      		<label>Drag and drop or select Image</label>
					    	</div>
					  	</div>
					  	<div class="file-upload-content">
					    	<img class="file-upload-image" src="#" alt="your image" />
					    	<div class="image-title-wrap">
					      		<button type="button" onclick="removeUpload()" class="remove-image"><span class="image-title"></span>&nbsp;<i class='fas fa-trash-alt' style='font-size:24px'></i></button>
					    	</div>
					  	</div>
					</div>
	      		</div>
	      		<div class="modal-footer">
	      			<button type="submit" class="btn btn-primary">Save</button>
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	     		</div>
     		</form>
    	</div>
  	</div>
</div>

<!-- Delete Modal -->
<div id="deleteCarouselModal" class="modal fade" role="dialog">
 	<div class="modal-dialog">
		<!-- Modal content-->
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h4 class="modal-title">刪除幻燈片</h4>
	      	</div>
	      	<!-- Modal Body -->
	     	<div class="modal-body" style="text-align: center;">
	      		<div class="deleteGallery">
				  	@foreach($carousels as $carousel)
				  		<div class="deleteImgContainer"><img src="{{ asset('carousel_Img/'.$carousel->img_url) }}"></div>
				  	@endforeach
				</div>
	      	</div>
	      	<div class="modal-footer">
	      		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	     	</div>
    	</div>
  	</div>
</div>
@endsection
@section('js')
<script>
var slides = $('.slide-text');
$('.slider').glide({
	type: "slider",
    autoplay: 5000,
    hoverpause: false,
    arrows: '.slider',
    navigation: '.slider',
    arrowRightText: '',
    arrowLeftText: '',
    afterInit: 
    	function(){
        	$(slides).eq(-this.currentSlide).addClass('drop');},
    beforeTransition: 
        function(){
          	$(slides).eq(-this.currentSlide).removeClass('drop');},
    afterTransition: 
        function(){
          	$(slides).eq(-this.currentSlide).addClass('drop');},
});


// 圖片上傳
function readURL(input) {
 	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
	    	$('.image-upload-wrap').hide();
	    	$('.file-upload-image').attr('src', e.target.result);
	    	$('.file-upload-content').show();
			$('.image-title').html(input.files[0].name);
    	};
    	reader.readAsDataURL(input.files[0]);
  	} else {
    	removeUpload();
  	}
}

function removeUpload() {
  	$('.file-upload-input').replaceWith($('.file-upload-input').clone());
  	$('.file-upload-content').hide();
  	$('.image-upload-wrap').show();
}

$('.image-upload-wrap').bind('dragover', function () {
	$('.image-upload-wrap').addClass('image-dropping');
});

$('.image-upload-wrap').bind('dragleave', function () {
	$('.image-upload-wrap').removeClass('image-dropping');
});

</script>
@stop