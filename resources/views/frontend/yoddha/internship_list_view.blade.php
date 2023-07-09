@extends('frontend.layouts.default')
@section('page_title', 'Register as Cyber Yoddha')
@section('content')

<nav class="breadcrumb">
   <a class="breadcrumb-item" href="{{app_url()}}">Homepage</a>
   <span class="breadcrumb-item active">Student Internship List</span>
</nav>
<div class="container mb-5">   
   <div class="card table-responsive">
      <div class="table-wrapper m-5">
         <table class="datatblstd table table-bordered table-striped nowrap" width="100%">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>DOB</th>
                  <th>Student or Working Profetional?</th>
                  <th>Industry Professional</th>
                  <th>Last Examination passed/appeared</th>
                  <th>Organization</th>
                  <th>Contribution 1</th>
                  <th>Contribution 2</th>
                  <th>Contribution 3</th>                     
                  <th>Profesional Certificate/ Training On Cyber Security?</th>
                  <th>Experience In Cyber Security?</th>
                  <th>Any awards/recognition in the area of cyber security?</th>
                  <th>Description</th>
                  <th>Paper/Publications in the area of cyber Security?</th>
                  <th>Description</th>
                  <th>Have you ever thought of cyber security?</th>
                  <th>Description</th>
                  <th>Any other information</th>
                  <th>CV Details</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody class="text-center">
               @if(!$students->isEmpty())
               @foreach ($students as $item)
                  <tr>
                     <td>{{ucwords($item->c_name)}}</td>
                     <td>{{$item->c_phone_no}}</td>
                     <td>{{$item->c_email}}</td>
                     <td>{{date('d-m-Y',strtotime($item->c_dob))}}</td>
                     <td>{{$item->cand_step}}</td>
                     @if($item->cand_step == 'Industry Professional')
                     <td>{{$item->c_last_status}}</td>
                     <td></td>
                     @else
                     <td></td>
                     <td>{{$item->c_last_status}}</td>
                     @endif                     
                     <td>{{strtoupper($item->c_org)}}</td>
                     <td>{{ucwords($item->c_cntribut1)}}</td>
                     <td>{{ucwords($item->c_cntribut2)}}</td>
                     <td>{{ucwords($item->c_cntribut3)}}</td>
                     <td>@if($item->c_prf_crtf == 1){{"Yes"}}@else{{"No"}}@endif</td>
                     @if($item->c_prf_crtf == 1)
                     <td>{{$item->c_year_exp }} Year {{$item->c_month_exp}} Months</td>
                     @if($item->c_req_crtf == 1)
                     <td>{{"Yes"}}</td>
                     <td>{{$item->c_awrd_crtf}}</td>
                     @else
                     <td>{{"No"}}</td>
                     <td></td>
                     @endif

                     @if($item->c_publc_crtf == 1)
                     <td>{{"Yes"}}</td>
                     <td>{{$item->c_papr_crtf}}</td>
                     @else
                     <td>{{"No"}}</td>
                     <td></td>
                     @endif

                     @if($item->c_thng_crtf == 1)
                     <td>{{"Yes"}}</td>
                     <td>{{$item->c_thougt_crtf}}</td>
                     @else
                     <td>{{"No"}}</td>
                     <td></td>
                     @endif

                     @else
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     @endif
                     <td>{{ucwords($item->othr_inf)}}</td>
                     <td><a target="_blank" class="btn btn-primary btn-sm" href="{{url($item->c_cv)}}">View</a></td>
                     <td>{{ucwords($item->status)}}</td>
                     <td>
                        <div class="btn-group">
                           <button type="button" class="btn btn-sm btn-success status_change" data-toggle="tooltip" data-name="approved" data-placement="top" title="Approved" value="{{$item->id}}"><i class="fa fa-check" aria-hidden="true"></i></button>
                           <button type="button" class="btn btn-sm btn-danger status_change" data-toggle="tooltip" data-placement="top" data-name="reject" title="Reject" value="{{$item->id}}"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                     </td>
                  </tr>
               @endforeach
               @endif
            </tbody>
         </table>
      </div>
   </div>
   <div class="modal" id="statusModal">
      <div class="modal-dialog">
         <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Modal Heading</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>

         <!-- Modal body -->
         <div class="modal-body">
           <form>
               form
           </form>
         </div>

         <!-- Modal footer -->
         <div class="modal-footer">
            <input type="text" name="c_id" id="c_id">
           <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>

       </div>
     </div>
   </div>

   {!!flash_message()!!}
</div>      


@stop