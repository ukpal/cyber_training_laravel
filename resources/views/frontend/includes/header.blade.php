<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keyword" content="@yield('page_keywords', '')">
    <meta name="description" content="@yield('page_description', '')">
    <meta name="author" content="@yield('meta_author', 'Aranax Technologies Pvt Ltd')">

    <title>@yield('page_title')</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{app_url()}}assets/img/logo.png">
    <link rel="apple-touch-icon" href="{{app_url()}}assets/img/favicon/apple-touch-icon.png">

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="{{app_url()}}assets/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
    <link rel="stylesheet" href="{{app_url()}}assets/lib/font-awesome/css/font-awesome.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{app_url()}}assets/css/styles.css">
    <link href="{{app_url()}}assets/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    

</head>

<body id="page-top">
    <div class="topbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 col-xs-12">
                    <a class="navbar-brand js-scroll-trigger" href="#page-top">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{app_url()}}assets/img/logo.png" alt="WB Logo">
                            <h1 class="">Cyber Yoddha<br><small>Cyber Security Incident Response Team, West Bengal</small></h1>
                        </div>
                    </a>
                </div>
                <div class="col-sm-7 col-xs-12 d-flex justify-content-end align-items-center">
                    <div class="call-to-action">
                        <a href="/cyber-yoddha/register" class="">Register as Cyber Yoddha</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-light navbar-expand-lg" id="mainNav">
        <div class="container-fluid">
            <button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav mx-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link py-2 px-3 rounded js-scroll-trigger" href="/">
                        Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 px-3 rounded js-scroll-trigger" href="/cyber-yoddha/about-cyber-yoddha">
                        About Cyber Yoddha
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 px-3 rounded js-scroll-trigger" href="/contact-us">
                        Contact Us
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link py-2 px-3 rounded js-scroll-trigger" href="/cyber-yoddha/yoddha-login">Login
                        </a>
                    </li>                        
                </ul>
            </div>
        </div>
    </nav>
    <!-- /NAVBAR -->

