@extends('frontend.layouts.default')
@section('page_title', 'Register as Cyber Yoddha')
@section('content')
<nav class="breadcrumb">
   <a class="breadcrumb-item" href="{{app_url()}}">Homepage</a>
   <span class="breadcrumb-item active">Register</span>
</nav>
<div class="container">
   <div class="row">
      
      <div class="com-md-12">
         <h5 class="text-cnt"> Online application for internship </h5>
      </div>
   </div>
   <form action="submission" method="post" enctype="multipart/form-data">@csrf
      <div class="form-group">
         <div class="row mr-3">
            <div class="col-md-5">
               <label class="control-label">Are you a permanent resident of West Bengal?<sup>*</sup></label>
            </div>
            <div class="col-md-3">
               {{ Form::select('c_prmt_adress', array(''=>'--Select--','1'=>'Yes','0'=>'No'), null, ['id' => 'c_prmt_adress', 'class' => 'form-control c_prmt_adress']) }}
            </div>
         </div>
      </div>
      <div class="form1" style="display:none">
         <div class="form-group">
            <div class="row mr-3">
               <div class="col-md-5">
                  <label class="control-label">Name<sup>*</sup></label>
               </div>
               <div class="col-md-3">
                  <input type="text" class="form-control c_name" name="c_name" id="c_name" placeholder="Candidate Name" maxlength="">
               </div>
            </div>
         </div>
         <div class="form-group">
            <div class="row mr-3">
               <div class="col-md-5">
                  <label class="control-label">Mobile<sup>*</sup></label>
               </div>
               <div class="col-md-3">
                  <input type="text" class="form-control c_phone_no" name="c_phone_no" id="c_phone_no" placeholder="Phone Number" maxlength="10">
               </div>
            </div>
         </div>
         <div class="form-group">
            <div class="row mr-3">
               <div class="col-md-5">
                  <label class="control-label">Email<sup>*</sup></label>
               </div>
               <div class="col-md-3">
                  <input type="text" class="form-control c_email" name="c_email" id="c_email" placeholder="Email Id" maxlength="">
               </div>
            </div>
         </div>
         <div class="form-group">
            <div class="row mr-3">
               <div class="col-md-5">
                  <label class="control-label">DOB<sup>*</sup></label>
               </div>
               <div class="col-md-3">
                  <input type='date' name='c_dob' class='form-control c_dob' id='c_dob' value="">
               </div>
            </div>
         </div>
         <div class="form-group">
            <div class="row mr-3">
               <div class="col-md-5">
                  <label class="control-label">Current Status<sup class="text-danger">*</sup></label>
               </div>
               <div class="col-md-3">
                  <div id="radio">
                     <div class="radio">
                        <label><input type="radio" value="Student" name="cand_step" > Student</label>
                     </div>
                     <div class="radio">
                        <label><input type="radio" value="Industry Professional" name="cand_step" > Working Professional</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="form2" style="display:none">
            <div class="form-group">
               <div class="row mr-3">
                  <div class="col-md-5">
                     <label class="control-label">Last Examination passed/appeared<sup>*</sup></label>
                  </div>
                  <div class="col-md-3">
                     {{ Form::select('c_last_status', array('School Level'=>'School Level','Under Graduate'=>'Under Graduate','Post Graduate'=>'Post Graduate','Research'=>'Research'), null, ['id' => 'c_last_status', 'class' => 'form-control c_last_status']) }}
                  </div>
               </div>
            </div>
            <div class="form-group">
               <div class="row mr-3">
                  <div class="col-md-5">
                     <label class="control-label">Institution Name<sup>*</sup></label>
                  </div>
                  <div class="col-md-3">
                     <input type="text" class="form-control c_inst" name="institution" id="c_inst" placeholder="Institution" maxlength="">
                  </div>
               </div>
            </div>
         </div>
         <div class="form3" style="display:none">
            <div class="form-group">
               <div class="row mr-3">
                  <div class="col-md-5">
                     <label class="control-label">Industry Professional<sup>*</sup></label>
                  </div>
                  <div class="col-md-3">
                     {{ Form::select('c_prf_status', array('Full time job'=>'Full time job ','Part time job'=>'Part time job','Freelancer'=>'Freelancer',
                     'Not engaged to anyactivity'=>'Not engaged to any activity'), null, ['id' => 'c_prf_status', 'class' => 'form-control c_prf_status']) }}
                  </div>
               </div>
            </div>
            <div class="form-group">
               <div class="row mr-3">
                  <div class="col-md-5">
                     <label class="control-label">Organization<sup>*</sup></label>
                  </div>
                  <div class="col-md-3">
                     <input type="text" class="form-control c_org" name="c_org" id="c_org" placeholder="Organization" maxlength="">
                  </div>
               </div>
            </div>
         </div>
         
         <div class="form-group">
            <div class="row mr-3">
               <div class="col-md-8">
                  <label class="control-label">Your three most prominat contribution in the area of cyber security<sup></sup></label>
                  <input type="text" class="form-control c_cntribut1" name="c_cntribut1" id="c_cntribut1" placeholder="Contribution1" maxlength=""><br>
                  <input type="text" class="form-control c_cntribut2" name="c_cntribut2" id="c_cntribut2" placeholder="Contribution2" maxlength=""><br>
                  <input type="text" class="form-control c_cntribut3" name="c_cntribut3" id="c_cntribut3" placeholder="Contribution3" maxlength="">
               </div>
            </div>
         </div>
         <div class="form-group">
            <div class="row mr-3">
               <div class="col-md-5">
                  <label class="control-label">Do you have any profesional certificate/ training on cyber security?<sup>*</sup></label>
               </div>
               <div class="col-md-3">
                  {{ Form::select('c_prf_crtf', array('0'=>'No ','1'=>'Yes'), null, ['id' => 'c_prf_crtf', 'class' => 'form-control c_prf_crtf']) }}
               </div>
            </div>
         </div>
         <div class="form4" style="display:none">
            <div class="form-group" >
               <div class="row mr-3" id="exp">
                  <div class="col-md-5">
                     <label class="control-label">Your experience in cyber security?<sup>*</sup></label>
                  </div>
                  <div class="col-md-1">
                     <label class="control-label">Year</label>
                     <select name="c_year_exp" class="form-control c_year_exp" id="c_year_exp">
                        <?php 
                           for($i=0; $i<=25; $i++)
                           {
                           ?>
                        <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                        <?php
                           }
                           ?>
                        <option name="c_year_exp"></option>
                     </select>
                  </div>
                  <div class="col-md-1">
                     <label class="control-label">month</label>
                     <select name="c_month_exp" class="form-control c_month_exp" id="c_month_exp">
                        <?php 
                           for($i=0; $i<=11; $i++)
                           {
                           ?>
                        <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                        <?php
                           }
                           ?>
                        <option name="c_month_exp"></option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <div class="row mr-3">
                  <div class="col-md-5">
                     <label class="control-label">Any awards/recognition in the area of cyber security?<sup>*</sup></label>
                  </div>
                  <div class="col-md-3">
                     {{ Form::select('c_req_crtf', array('0'=>'No ','1'=>'Yes'), null, ['id' => 'c_req_crtf', 'class' => 'form-control c_req_crtf']) }}
                  </div>
               </div>
            </div>
            <div class="awrd" style="display:none">
               <div class="form-group">
                  <div class="row mr-3">
                     <div class="col-md-8">
                        <input type="text" class="form-control c_awrd_crtf " name="c_awrd_crtf" id="c_awrd_crtf" placeholder="Details" maxlength="">
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <div class="row mr-3">
                  <div class="col-md-5">
                     <label class="control-label">Paper/Publications in the area of cyber Security?<sup>*</sup></label>
                  </div>
                  <div class="col-md-3">
                     {{ Form::select('c_publc_crtf', array('0'=>'No ','1'=>'Yes'), null, ['id' => 'c_publc_crtf', 'class' => 'form-control c_publc_crtf']) }}
                  </div>
               </div>
            </div>
            <div class="papr" style="display:none">
               <div class="form-group">
                  <div class="row mr-3">
                     <div class="col-md-8">
                        <input type="text" class="form-control c_papr_crtf " name="c_papr_crtf" id="c_papr_crtf" placeholder="Details" maxlength="">
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <div class="row mr-3">
                  <div class="col-md-5">
                     <label class="control-label">Have you ever thought of cyber security?<sup>*</sup></label>
                  </div>
                  <div class="col-md-3">
                     {{ Form::select('c_thng_crtf', array('0'=>'No ','1'=>'Yes'), null, ['id' => 'c_thng_crtf', 'class' => 'form-control c_thng_crtf']) }}
                  </div>
               </div>
            </div>
            <div class="thougt" style="display:none">
               <div class="form-group">
                  <div class="row mr-3">
                     <div class="col-md-8">
                        <input type="text" class="form-control c_thougt_crtf " name="c_thougt_crtf" id="c_thougt_crtf" placeholder="Details" maxlength="">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="form-group">
            <div class="row mr-3">
               <div class="col-md-5">
                  <label class="control-label">Any other information you want to share</label>
               </div>
               <div class="col-md-3">
                  <textarea class="form-control othr_inf" name="othr_inf" id="othr_inf" placeholder=" " maxlength="200"></textarea>
               </div>
            </div>
         </div>
         <div class="form-group">
            <div class="row mt-3">
               <div class="col-md-5">
                  <label class="control-label">Upload CV  <sup>*</sup></label>
               </div>
               <div class="col-md-3">
                  <input type='file' name='c_cv' value='' class='form-control c_cv' id='c_cv' accept=".pdf" >
               </div>
            </div>
         </div>
         <br>
      </div>
      <div class="form-group">
         <div class="row mt-3">
            <div class="col-md-8 text-center">
               <button type="button" class="btn btn-primary btn-apply">Submit</button>
            </div>
         </div>
      </div>
   </form>      
   <br>
   {!!flash_message()!!}
</div>
</div>
</div>            
@stop