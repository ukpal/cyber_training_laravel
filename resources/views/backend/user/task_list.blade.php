@extends('backend.layouts.default')
@section('page_title', 'List of Tasks')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{app_url()}}dashboard">Dashboard</a>
    <span class="breadcrumb-item active">Allocated Task List</span>
</nav>

<div class="sl-pagebody" style="min-height: calc(100vh - 170px);">

    <div class="card pd-20 pd-sm-40">
        <div class="row mb-3">
            <div class="col-sm-6"><h6 class="card-body-title">Allocated Task List {!!flash_message()!!}</h6></div>
        </div>
        <div class="table-wrapper">
            <table class="datatbl table display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th class="wd-20p">SL.</th>                       
                        <th class="wd-20p">Title</th>     
                        @if (!empty($tasks[0]->assigned_by))
                        <th class="wd-20p">Assigned By</th>                       
                        @endif                  
                        <th class="wd-20p">Status</th>                       
                        <th class="wd-20p">Action</th>                       
                    </tr>
                </thead>
                <tbody>
                    @if(!$tasks->isEmpty())
                        @foreach ($tasks as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->title}}</td>  
                            @if (!empty($item->assigned_by))                        
                            <td>{{$item->assigned_by}}</td>  
                            @endif                        
                            <td>{{$item->status}}</td>                          
                            <td>
                                <a href="{{url('view-task/'.encrypt($item->id))}}" class="btn btn-dark btn-sm assign-task-btn" >Details</a>
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