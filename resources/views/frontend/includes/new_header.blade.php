<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Homepage</title>
    <style>
        body{
            font-family: Verdana, Geneva, Tahoma, sans-serif
        }
        .main{
          /* background-image: linear-gradient(#ffffff00, #ffffff00),url("{{asset('assets/img/bg.png')}}"); */
          /* background-image: linear-gradient(#ffffffcf, #ffffffcf),url("https://cdn.pixabay.com/photo/2019/11/08/10/34/cyber-4610993_960_720.jpg"); */
          background-image: linear-gradient(#d2d2d2e3, #d2d2d2db),url("{{asset('assets/img/banner-4.png')}}");
          background-position: center;
          background-repeat: no-repeat;
          background-size:cover;
        }
    </style>
  </head>
  <body>
      <div class="topbar py-2">
        <div class="row mx-0 align-items-center">
            <div class="col-6">
                <div class="row mx-0 ">
                    <div class="col-1">
                        <img src="{{app_url()}}assets/img/logo.png" alt="WB Logo">
                    </div>
                    <div class="col-11 d-none d-lg-block">
                        <p><span class="fs-3 fw-bolder">Bengal Cyber Yoddha Team</span><br><span class="text-primary">Cyber Security Incident Response Team, West Bengal</span></p>
                    </div>
                </div>
                {{-- <div class="d-flex justify-content-center align-items-center">
                    <img src="{{app_url()}}assets/img/logo.png" alt="WB Logo">
                    <p><span class="fs-4">Cyber Yoddha</span><br><span class="fs-5">Cyber Security Incident Response Team, West Bengal</span></p>
                </div> --}}
            </div>
            <div class="col-6">
                {{-- <a href="" class="btn btn-lg text-white float-end " style="background-image: linear-gradient(to right, rgb(142, 45, 226), rgb(74, 0, 224));">Register as Cyber Yoddha</a> --}}
                <a href="/cyber-yoddha/register" class="btn-info text-dark btn-lg float-end btn shadow-lg fw-bold" style="border-bottom: 3px solid black">
                  
                  Register
                </a>
            </div>
        </div>
      </div>

      @include('frontend/includes/navbar')