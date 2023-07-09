@extends('backend.layouts.default')
@section('page_title', 'Add '. ucwords(str_replace("-", " ", $module)) )
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{app_url()}}dashboard">Dashboard</a>
    <span class="breadcrumb-item active">Add {{ ucwords(str_replace("-", " ", $module)) }} Members</span>
</nav>

<div class="sl-pagebody" style="min-height: calc(100vh - 170px);">

    <div class="card pd-20 pd-sm-40">
        <div class="row mb-3">
            <div class="col-sm-6"><h6 class="card-body-title">Add {{ ucwords(str_replace("-", " ", $module)) }} Members</h6></div>
            <div class="col-sm-6 text-right"></div>
        </div>
        <form action="{{url('/members/save-').$module}}" method="post" id="frm" enctype="multipart/form-data">@csrf
            <div class="row mb-3">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Full Name</label>
                        <input type="text" name="fullnm" id="fullnm" placeholder="" class="form-control text-uppercase">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Designation</label>
                        <input type="text" name="designation" id="designation" placeholder="" class="form-control text-uppercase">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Organisation</label>
                        <input type="text" name="organisation" id="organisation" placeholder="" class="form-control text-uppercase">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Mobile</label>
                        <input type="text" name="mobile" id="mobile" placeholder="Enter 10 Digit Mobile Number" class="form-control" maxlength="10">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Email Address</label>
                        <input type="text" name="email" id="email" placeholder="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Role</label>
                        <div id="role_area">
                            <div class="mb-3 ml-4"><input class="form-check-input check_box" type="checkbox" value="scrutiny-committee" name="role[]" id="role1">
                            <label class="form-check-label" for="role1">
                            Scrutiny Committee Member
                            </label></div>
                            <div class=" ml-4"><input class="form-check-input check_box" type="checkbox" value="mentor-group" name="role[]" id="role2">
                            <label class="form-check-label" for="role2">
                            Mentor Group Member
                            </label></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="button" class="add_member btn btn-primary">Add Member</button>
            </div>
        </form>                    
    </div>   
</div>

@stop