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
                    <label class="font-weight-bold">Name</label>
                    <input type="text" class="form-control" value="{{strtoupper($yoddha->c_name)}}" disabled>
                </div>                
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Phone</label>
                    <input type="text" class="form-control" value="{{strtoupper($yoddha->c_phone_no)}}" disabled>
                </div>                
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Email</label>
                    <input type="text" class="form-control" value="{{strtoupper($yoddha->c_email)}}" disabled>
                </div>                
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">DOB</label>
                    <input type="text" class="form-control" value="{{date('d-m-Y',strtotime($yoddha->c_dob))}}" disabled>
                </div>                
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Student/Working professional</label>
                    <input type="text" class="form-control" value="{{strtoupper($yoddha->cand_step)}}" disabled>
                </div>                
            </div>
            @if($yoddha->cand_step == 'Student')
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Last Examination passed/appeared</label>
                    <input type="text" class="form-control" value="{{strtoupper($yoddha->c_last_status)}}" disabled>
                </div>                
            </div>
            @else
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Industry Professional</label>
                    <input type="text" class="form-control" value="{{strtoupper($yoddha->c_last_status)}}" disabled>
                </div>                
            </div>
            @endif
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Organization</label>
                    <input type="text" class="form-control" value="{{strtoupper($yoddha->c_org)}}" disabled>
                </div>                
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-8"><h6 class="card-body-title"> three most prominant contribution in the area of cyber security</h6></div>
            <div class="col-sm-6 text-right"></div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Contribution 1</label>
                    <input type="text" class="form-control" value="{{ucwords($yoddha->c_cntribut1)}}" disabled>
                </div>                
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Contribution 2</label>
                    <input type="text" class="form-control" value="{{ucwords($yoddha->c_cntribut1)}}" disabled>
                </div>                
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Contribution 3</label>
                    <input type="text" class="form-control" value="{{ucwords($yoddha->c_cntribut1)}}" disabled>
                </div>                
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-4 mt-2"><h6 class="card-body-title">profesional certificate/ training on cyber security?</h6></div>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="{{$yoddha->c_prf_crtf=="1"?'YES':'NO'}}" disabled>
            </div>
        </div>
        <div class="row mb-3">
            @if($yoddha->c_prf_crtf == 1) 
                <div class="col-sm-4">
                    <label class="font-weight-bold">Experience in cyber security :</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{$yoddha->c_year_exp}}Years {{$yoddha->c_month_exp}}Months" disabled>
                </div><br><br><br>           
                <div class="col-sm-4 mt-3">
                    <label class="font-weight-bold">Awards/Recognition of cyber security :</label>
                </div>
                <div class="col-sm-2">                   
                    <input type="text" class="form-control" value="{{$yoddha->c_req_crtf=="1"?'YES':'NO'}}" disabled>
                </div>
                @if($yoddha->c_req_crtf == 1)
                <div class="col-sm-6">                   
                    <input type="text" class="form-control" value="{{$yoddha->c_awrd_crtf}}" disabled>
                </div>
                @endif

                <div class="col-sm-4 mt-3">
                    <label class="font-weight-bold">Paper/Publications in the area of cyber Security :</label>
                </div>
                <div class="col-sm-2">                   
                    <input type="text" class="form-control" value="{{$yoddha->c_publc_crtf=="1"?'YES':'NO'}}" disabled>
                </div>
                @if($yoddha->c_publc_crtf == 1)
                <div class="col-sm-6">                   
                    <input type="text" class="form-control" value="{{$yoddha->c_papr_crtf}}" disabled>
                </div>
                @endif

                <div class="col-sm-4 mt-2">
                    <label class="font-weight-bold">Have you ever thought of cyber security :</label>
                </div>
                <div class="col-sm-2">                   
                    <input type="text" class="form-control" value="{{$yoddha->c_thng_crtf=="1"?'YES':'NO'}}" disabled>
                </div>
                @if($yoddha->c_thng_crtf == 1)
                <div class="col-sm-6">                   
                    <input type="text" class="form-control" value="{{$yoddha->c_thougt_crtf}}" disabled>
                </div>
                @endif
            @endif
        </div>

        <div class="row mb-3">
            <div class="col-sm-7 mt-2"><h6 class="card-body-title">Any other information you want to share</h6></div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-7">
                <div class="form-group">
                    {{-- <label class="font-weight-bold">Descriptions</label> --}}
                    <textarea class="form-control" rows="3" readonly>{{$yoddha->othr_inf}}</textarea>
                </div>
            </div>
            <div class="col-sm-5 mt-5">
                <div class="form-group">
                    <label class="control-label">Resume(CV)</label>
                    <a class="font-weight-bold" target='_blank' href='{{app_url().$yoddha->c_cv}}'>&nbsp;&nbsp;View uploaded document</a>
                </div>
            </div>
        </div>

        @if(!empty($scutiny))
            <div class="row mb-3">
                <div class="col-sm-7 mt-2"><h6 class="card-body-title">Scrutiny Committee</h6></div>
            </div>
            @foreach($scutiny as $s)
                <div class="card-body bg-dark mt-2">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label class="font-weight-bold">Scrutiny Member Name:</label>
                            <input type="text" class="form-control" value="{{$s->fullname}}" disabled>
                        </div>
                        <div class="col-sm-4">
                            <label class="font-weight-bold">Scrutiny Status:</label>
                            <input type="text" class="form-control" value="{{ucwords(str_replace('_',' ',$s->s_status))}}" disabled>
                        </div>
                        <div class="col-sm-4">
                            <label class="font-weight-bold">Scrutiny Remarks:</label>
                            <input type="text" class="form-control" value="{{ucwords($s->s_remarks)}}" disabled>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <br><br>
        @if($yoddha->status == 'pending')
            {{ Form::open(['url' => '/update-status', 'method' => 'post', 'class' => 'form']) }}
            <div class="form-group">
                <input type="hidden" name="c_id" value="{{$yoddha->id}}">
                <input type="hidden" name="btn_status" id="btn_status">
            </div><!-- form-group -->
            <div class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-info status_change mr-2" value="approved">Approve</button>
                    <button type="button" class="btn btn-danger status_change" value="rejected">Reject</button>
                </div>
            </div>
        @elseif($yoddha->status == 'approved')
            <div class="text-center">
                <button type="button" class="btn btn-info btn-lg">Approved</button>
            </div>
        @else
            <div class="text-center">
                <button type="button" class="btn btn-danger btn-lg">Rejected</button>
            </div>    
        @endif
    </div>   
</div>
@stop
