@extends('backend.layouts.default')
@section('page_title', 'List of Yoddhas')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{app_url()}}dashboard">Dashboard</a>
    <span class="breadcrumb-item active">My Tasks</span>
</nav>

<div class="sl-pagebody" style="min-height: calc(100vh - 170px);">

    <div class="card pd-20 pd-sm-40">
        <div class="row mb-3">
            <div class="col-sm-6"><h6 class="card-body-title">My Tasks {!!flash_message()!!}</h6></div>
        </div>
        <div class="table-wrapper">
            <table class="datatbl table display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th class="wd-20p">Title</th>
                        <th class="wd-20p">Assigned</th>
                        <th class="wd-20p">Status</th>                       
                        <th class="wd-20p">Action</th>                       
                    </tr>
                </thead>
                <tbody>
                    @if(!$tasks->isEmpty())
                        @foreach ($tasks as $item)
                        <tr>
                            <td>{{$item->title}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->status}}</td>                         
                            <td>
                                <a href="{{url('/cyber-yoddha/view-task/'.encrypt($item->id))}}" class="btn btn-dark btn-sm assign-task-btn" >Details</a>
                            </td>                         
                        </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td colspan="5">No data found</td>
                        </tr>    
                    @endif
                </tbody>
            </table>
        </div>            
    </div>    
</div>

@stop