@extends('backend.layouts.login')
@section('page_title', 'Signin')
@section('content')

<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Cyber Yoddha <span class="tx-info tx-normal">Admin</span></div>
        <div class="tx-center mg-b-60">Authenticate yourself to proceed further</div>

        {{ Form::open(['url' => '/login', 'method' => 'post', 'class' => 'form']) }}
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter email id or mobile number">
            </div><!-- form-group -->
            <button type="button" class="btn btn-info btn-block btn-login">Verify</button>
        </form>

    </div><!-- login-wrapper -->
</div><!-- d-flex -->

@stop