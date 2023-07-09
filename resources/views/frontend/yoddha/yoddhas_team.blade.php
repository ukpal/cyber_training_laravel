@extends('backend.layouts.default')
@section('page_title', 'List of Yoddhas')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{app_url()}}dashboard">Dashboard</a>
    <span class="breadcrumb-item active">Yoddhas Team Members</span>
</nav>

<div class="sl-pagebody" style="min-height: calc(100vh - 170px);">

    <div class="card pd-20 pd-sm-40">
        <div class="row mb-3">
            <div class="col-sm-6"><h6 class="card-body-title">Yoddhas Team</h6></div>
        </div>
        <div class="table-wrapper">
            <table class="datatbl table display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th class="wd-20p">Fullname</th>
                        <th class="wd-20p">Organisation</th>
                        <th class="wd-20p">Contact</th>
                        <th class="wd-10p">Is Active?</th>
                        <th class="wd-10p">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$yoddhas->isEmpty())
                        @foreach ($yoddhas as $item)
                        <tr>
                            <td>{{$item->fullname}}</td>
                            <td>{{$item->organisation}}</td>
                            <td>{{$item->email}}<br>{{$item->phone}}</td>
                            <td>{!! printActiveStatus($item->is_active) !!}</td>
                            <td>{{$item->role}}</td>
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