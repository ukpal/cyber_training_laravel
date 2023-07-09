@extends('backend.layouts.login')
@section('page_title', 'Signin')
@section('content')

<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">
    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Cyber Yoddha <span class="tx-info tx-normal">Admin</span></div>
        <div class="tx-center mg-b-60">Select Your Role <strong></strong></div>
        {{ Form::open(['url' => '/login-as', 'method' => 'post', 'class' => 'form']) }}
            <div class="form-group">
                <label class="control-label">Login as </label>
                <select class="form-control" name="role">
                    <option value="">Choose Role</option>
                    @foreach($data as $d)
                        <option value="{{$d['sess_admin_id']}}">{{strtoupper($d['sess_role_name'])}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="token" value="{{$data[0]['sess_admin_token']}}">
            </div><!-- form-group -->
            <button type="submit" class="btn btn-info btn-block btn-otp">Verify</button>
        </form>

    </div><!-- login-wrapper -->
</div>


@stop