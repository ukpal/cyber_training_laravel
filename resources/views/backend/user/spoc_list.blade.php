@extends('backend.layouts.default')
@section('page_title', 'List of Yoddhas SPoC')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{app_url()}}dashboard">Dashboard</a>
    <span class="breadcrumb-item active">Yoddhas SPoC</span>
</nav>

<div class="sl-pagebody" style="min-height: calc(100vh - 170px);">

    <div class="card pd-20 pd-sm-40">
        <div class="row mb-3">
            <div class="col-sm-6"><h6 class="card-body-title">SPoC List</h6></div>
        </div>
        <div class="table-wrapper">
            <table id="" class="datatbl table display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th class="wd-20p">SPoC Fullname</th>
                        <th class="wd-20p">SPoC Organization</th>
                        <th class="wd-20p">Contact</th>
                        <th class="wd-20p">Is Active ?</th>
                        <th class="wd-10p">Starts Date</th>
                        <th class="wd-10p">End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$spoc->isEmpty())
                        @foreach ($spoc as $item)
                        <tr>
                            <td>{{$item->spoc_nm}}</td>
                            <td>{{$item->organisation}}</td>
                            <td>{{$item->email}}<br>{{$item->phone}}</td>
                            <td>{!! printActiveStatus($item->is_active) !!}</td>
                            <td>{{ date('d-m-Y',strtotime($item->spoc_start_dt))}}</td>
                            @if(empty($item->spoc_end_dt))
                                <td><span class="badge badge-danger">Pursuing</span></td>
                            @else
                                <td>{{ date('d-m-Y',strtotime($item->spoc_end_dt))}}</td>
                            @endif
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