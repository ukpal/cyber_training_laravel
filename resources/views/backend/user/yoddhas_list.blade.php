@extends('backend.layouts.default')
@section('page_title', 'List of Yoddhas')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{app_url()}}dashboard">Dashboard</a>
    <span class="breadcrumb-item active">Registered Yoddhas</span>
</nav>

<div class="sl-pagebody" style="min-height: calc(100vh - 170px);">

    <div class="card pd-20 pd-sm-40">
        <div class="row mb-3">
            <div class="col-sm-6"><h6 class="card-body-title">Registered Yoddhas</h6></div>
            <div class="col-sm-6 text-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:90px;">
                      {{ ucfirst($status) }}
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{app_url()}}yoddha-registered/all">All</a>
                      <a class="dropdown-item" href="{{app_url()}}yoddha-registered/pending">Pending</a>
                      <a class="dropdown-item" href="{{app_url()}}yoddha-registered/rejected">Rejected</a>
                      <a class="dropdown-item" href="{{app_url()}}yoddha-registered/approved">Approved</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-wrapper">
            <table class="datatbl table display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th class="wd-15p">Fullname</th>
                        <th class="wd-20p">Profession</th>
                        <th class="wd-20p">Contact</th>
                        <th class="wd-10p">Status</th>
                        <th class="wd-10p">All Details</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$yoddhas->isEmpty())
                        @foreach ($yoddhas as $item)
                        <tr>
                            <td>{{ $item->c_name }}</td>
                            <td>{{ $item->cand_step }}</td>                            
                            <td>{{ $item->c_email }}<br>{{ $item->c_phone_no }}</td>
                            <td>{!! printYoddhaStatus($item->status) !!}</td>
                            <td><a href="/yoddha-details/{{$item->id}}" class="btn btn-info btn-sm">Details</a></td>                            
                        </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td colspan="6">No data found</td>
                        </tr>    
                    @endif
                </tbody>
            </table>
        </div>            
    </div>    
</div>

@stop