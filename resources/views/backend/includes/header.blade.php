<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta -->
<meta name="description" content="">
<meta name="author" content="Aranax Technologies">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>@yield('page_title')</title>

<!-- vendor css -->
<link href="{{app_url()}}assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="{{app_url()}}assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">
<link href="{{app_url()}}assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
{{-- <link href="{{app_url()}}assets/lib/rickshaw/rickshaw.min.css" rel="stylesheet"> --}}
{{-- <link href="{{app_url()}}assets/lib/datatables/jquery.dataTables.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- Theme CSS -->
<link rel="stylesheet" href="{{app_url()}}assets/css/admin.css?<?php echo uniqid();?>">