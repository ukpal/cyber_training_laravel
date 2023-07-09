@extends('backend.layouts.default')
@section('page_title', ucwords(str_replace("-", " ", $module)) )
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{app_url()}}dashboard">Dashboard</a>
    <span class="breadcrumb-item active">{{ ucwords(str_replace("-", " ", $module)) }}</span>
</nav>

<div class="sl-pagebody" style="min-height: calc(100vh - 170px);">

    <div class="card pd-20 pd-sm-40">
        <div class="row mb-3">
            <div class="col-sm-6"><h6 class="card-body-title">Personal Details</h6></div>
            <div class="col-sm-6 text-right"></div>
        </div>        
        <div class="row mb-3">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Fill Name</label>
                    <input type="text" class="form-control" value="{{strtoupper($data->fullname)}}" disabled>
                </div>                
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Phone</label>
                    <input type="text" class="form-control" value="{{strtoupper($data->phone)}}" disabled>
                </div>                
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Email</label>
                    <input type="text" class="form-control" value="{{strtoupper($data->email)}}" disabled>
                </div>                
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="font-weight-bold">Designation</label>
                    <input type="text" class="form-control" value="{{strtoupper($data->designation)}}" disabled>
                </div>                
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="font-weight-bold">Organization</label>
                    <input type="text" class="form-control" value="{{strtoupper($data->organisation)}}" disabled>
                </div>                
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Role</label>
                    <input type="text" class="form-control" value="{{strtoupper($data->role)}}" disabled>
                </div>                
            </div>
        </div>

                
    </div>   
</div>

@stop
