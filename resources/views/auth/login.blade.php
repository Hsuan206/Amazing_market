@extends('layouts.layout')
@section('title', '妙花種子')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('login/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/animate/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/css-hamburgers/hamburgers.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/animsition/css/animsition.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('login/css/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('login/css/main.css') }}">
<!--
<style>
    html, body {
      display: flex;
      justify-content: center;
      font-family: Roboto, Arial, sans-serif;
      font-size: 15px;
    }
    form {
      border: 5px solid #f1f1f1;
    }
    input[type=text], input[type=password] {
      width: 35%;
      padding: 16px 8px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    button {
      background-color: #8ebf42;
      color: white;
      padding: 14px 0;
      margin: 10px 0;
      border: none;
      cursor: grabbing;
      width: 35%;
    }
    h1 {
      text-align:center;
      fone-size:15;
    }
    button:hover {
      opacity: 0.8;
    }
    .formcontainer {
      text-align: center;
      margin: 24px 50px 12px;
    }
    .container {
      padding: 15px 0;
      text-align:center;
    }
    span.psw {
      float: right;
      padding-top: 0;
      padding-right: 15px;
    }
</style>
-->
@stop
@section('content')
<div class="container-login100" style="background-image: url('login/images/bg-01.jpg');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
      <form class="login100-form validate-form" method="post" action="{{ asset('/loginnow') }}">
          @csrf
        <span class="login100-form-title p-b-37">
          Sign In
        </span>

        <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
          <input class="input100" type="text" name="name" placeholder="Username" required>
          <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
          <input class="input100" type="password" name="password" placeholder="Password" required>
          <span class="focus-input100"></span>
        </div>  
            
          @if ($errors->has('name'))
            
          <div class="wrap-input100 validate-input m-b-20" style="color: red;" align="center" >密碼錯誤
              
          </div>
            
         @endif
        
          

        <div class="container-login100-form-btn">
          <button class="login100-form-btn">
            Login
          </button>
        </div>

        <div class="text-center p-t-57 p-b-20">

        </div>
      </form>

      
    </div>
  </div>
  
  

  <div id="dropDownSelect1"></div>
<!-- <form method="post" action="{{ asset('/loginnow') }}">
  @csrf
  <h1>Login</h1>
  <div class="formcontainer">
    <hr/>
    <div class="container">
      <label for="uname"><strong></strong></label>
      <input type="text" placeholder="Enter Username" name="name" required><br>
      <label for="psw"><strong></strong></label>
      <input type="password" placeholder="Enter Password" name="password" required>
    </div>
    <button type="submit" style="width: 15%;">Login</button>
  </div>
</form> -->
@endsection
    
@section('js')
<script src="{{ asset('login/vendor/animsition/js/animsition.min.js') }}"></script>
<script src="{{ asset('login/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('login/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('login/vendor/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('login/vendor/countdowntime/countdowntime.js') }}"></script>
<script src="{{ asset('login/js/main.js') }}"></script>
@stop