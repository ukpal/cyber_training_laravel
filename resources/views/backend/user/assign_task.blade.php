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
            <div class="col-sm-6"><h6 class="card-body-title">Assign Task</h6></div>
            <div class="col-sm-6 text-right"></div>
        </div>     
        <form action="{{url('assign-task')}}" enctype="multipart/form-data" method="POST">  
            @csrf
            <input type="hidden" name="id" value="{{$yoddha->id}}"> 
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="font-weight-bold">Name</label>
                        <input type="text" class="form-control" value="{{strtoupper($yoddha->fullname)}}" disabled>
                    </div>                
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="font-weight-bold">Title</label>
                        <input type="text" name="title" class="form-control" >
                    </div>                
                </div>            
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="font-weight-bold">Url</label>
                        <input type="url" name="url" class="form-control" >
                    </div>                
                </div>            
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="font-weight-bold">What to do?</label>
                        <textarea class="form-control" rows="3" name="what_to_do"></textarea>
                    </div>                
                </div>            
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="font-weight-bold">Upload docs.</label>
                        <input type="file" name="task_docs[]" multiple class="form-control">
                    </div>                
                </div> 
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>                         
                </div> 
            </div>
        </form>
    </div>   
</div>
@stop
