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
            <div class="col-sm-6"><h6 class="card-body-title">Edit Member Details</h6></div>
            {{-- <div class="col-sm-6 text-right"><a href="" class="btn btn-danger">Cancel</a></div> --}}
        </div>  
        {!!flash_message()!!}   
        <form action="{{url('edit-member')}}" method="POST"> 
        @csrf
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="row mb-3">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Fill Name</label>
                    <input type="text" class="form-control" name="fullname" value="{{strtoupper($data->fullname)}}" >
                </div>                
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{strtoupper($data->phone)}}" >
                </div>                
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Email</label>
                    <input type="text" class="form-control" name="email" value="{{strtoupper($data->email)}}" >
                </div>                
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="font-weight-bold">Designation</label>
                    <input type="text" class="form-control" name="designation" value="{{strtoupper($data->designation)}}" >
                </div>                
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="font-weight-bold">Organization</label>
                    <input type="text" class="form-control" name="organisation" value="{{strtoupper($data->organisation)}}" >
                </div>                
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="font-weight-bold">Status</label>
                    <select class="form-control" name="is_active">
                        <option selected value="">----Select----</option>
                        <option value="1" {{($data->is_active) ? 'selected' : ''}}>Active</option>
                        <option value="0" {{($data->is_active) ? '' : 'selected'}}>Inactive</option>
                    </select>
                </div>                
            </div>  
            
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg">Update</button>
            </div>
        </div>
        </form>      
                   
    </div>   
</div>

@stop
