@extends('backend.layouts.default')
@section('page_title', 'List of ' . ucwords(str_replace("-", " ", $module)) . ' Members')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{app_url()}}dashboard">Dashboard</a>
    <span class="breadcrumb-item active">{{ ucwords(str_replace("-", " ", $module)) }} Members</span>
</nav>

<div class="sl-pagebody" style="min-height: calc(100vh - 170px);">

    <div class="card pd-20 pd-sm-40">
        <div class="row mb-3">
            <div class="col-sm-6"><h6 class="card-body-title">{{ ucwords(str_replace("-", " ", $module)) }} Members</h6></div>
            @if(Session::get('admin')['sess_role_name'] == 'director' || Session::get('admin')['sess_role_name'] == 'system-admin')
            <div class="col-sm-6 text-right"><a href="{{url('/members/add-').$module}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Add new member"><i class="icon ion-person-add"></i> New Member</a></div>
            @endif
        </div>
        <div class="table-wrapper">
            <table class="datatbl table display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th class="wd-20p">Fullname</th>
                        <th class="wd-20p">Organisation</th>
                        <th class="wd-20p">Designation</th>
                        <th class="wd-20p">Contact</th>
                        <th class="wd-10p">Is Active?</th>
                        <th class="wd-10p">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$members->isEmpty())
                        @foreach ($members as $item)
                        <tr>
                            <td>{{$item->fullname}}</td>
                            <td>{{$item->organisation}}</td>
                            <td>{{$item->designation}}</td>
                            <td>{{$item->email}}<br>{{$item->phone}}</td>
                            <td>{!! printActiveStatus($item->is_active) !!}</td>
                            <td>
                                @if (Session::get('admin')['sess_role_name'] == 'system-admin')
                                <a href="{{url('edit-member/'.encrypt($item->id))}}" class="btn btn-sm btn-warning">edit</a>
                                @endif                  
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>            
    </div>    
</div>

@stop