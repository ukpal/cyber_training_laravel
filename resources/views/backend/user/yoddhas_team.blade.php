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
            <div class="col-sm-6"><h6 class="card-body-title">Yoddhas Team {!!flash_message()!!}</h6></div>
        </div>
        <div class="table-wrapper">
            <table class="datatbl table display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th class="wd-20p">Fullname</th>
                        <th class="wd-20p">Organisation</th>
                        <th class="wd-20p">Contact</th>
                        <th class="wd-10p">Status</th>
                        <th class="wd-10p">Role</th>
                        <th class="wd-10p">Active Task</th>
                        <th class="wd-10p">Action</th>
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
                            @if($item->role == 'spoc' )
                                <td>SPoC</td>
                            @else
                                <td>
                                    @if (Session::get('admin')['sess_role_name'] == 'system-admin')
                                    <button type="button" onclick="spocSet({{$item->id}})" class="btn btn-sm btn-outline-primary">Set as SPoC</button>
                                    @else
                                    Member
                                    @endif
                                </td>
                            @endif
                            <td>{{$item->current_task}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                      Select
                                    </a>                            
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @if ( $item->is_active)
                                        <a href="{{url('assign-task/'.encrypt($item->id))}}" class="dropdown-item" >Assign Task</a>
                                        @endif                        
                                        <a href="{{url('allocated-tasks/'.encrypt($item->id))}}" class="dropdown-item" >Allocated Tasks</a>
                                        @if ($item->is_active && Session::get('admin')['sess_role_name'] == 'system-admin')
                                        <a href="{{url('deactivate-yoddha/'.encrypt($item->id))}}" class="dropdown-item" >Deactivate</a>
                                        @endif
                                        @if (!$item->is_active && Session::get('admin')['sess_role_name'] == 'system-admin')
                                        <a href="{{url('activate-yoddha/'.encrypt($item->id))}}" class="dropdown-item" >Activate</a>                                     
                                        @endif
                                    </div>
                                </div>
                                
                            </td>
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



<script>      
    function spocSet(id){
        Swal.fire({
            title: 'Are you Sure ?',
            text: "To Change SPoC ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {            
                $.ajax({
                    url:'{{ url("/spoc-change")}}',
                    type:"POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id:id},                   
                    success:function(data){                       
                        if(data.type =='success'){
                            Swal.fire({icon: data.type,title: data.title,text: data.text});
                            location.href = '{{ url("/yoddha-team")}}';
                        }
                    } 
                });
            }
        })
    }
    
</script>

@stop