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
            <div class="col-sm-8"><h6 class="card-body-title">three most prominant contribution in the area of cyber security</h6></div>
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

        @if(empty($scutiny))
            <div class="text-center">
                <button type="button" class="btn btn-primary btn-sm" data-toggle='modal' data-target='#scrutinyModal'>Scrutinize</button>
            </div>        
        @else        
            <div class="row mb-3">
                <div class="col-sm-7 mt-2"><h6 class="card-body-title">Scrutiny Status</h6></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Status</label>
                        <input type="text" class="form-control" value="{{ucwords(str_replace('_',' ',$scutiny->s_status))}}" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Remarks</label>
                        <textarea class="form-control" rows="3" readonly>{{ucwords($scutiny->s_remarks)}}</textarea>
                    </div>
                </div>
            </div>
        @endif
                
    </div>   
</div>

{{-- All Modal Starts Here --}}
<div class="modal fade" id="scrutinyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Scrutiny</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['url' => '/scrutiny-status', 'method' => 'post', 'class' => 'form']) }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="control-label">Status</label> 
                                <select class="form-control" name ="s_status" id="s_status">
                                    <option value="">--Select Status--</option>
                                    <option value="recommended">Recommended</option>
                                    <option value="not_recommended">Not recommended</option>
                                </select>
                            </div>                        
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="control-label">Remarks</label> 
                                <textarea class="form-control" name="s_remarks" id="s_remarks" placeholder="Reamrks"></textarea>
                            </div>                        
                        </div>                    
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="yoddha_reg_id" value="{{$yoddha->id}}">
                    <button type="button" class="btn btn-primary scrutiny_commity">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
