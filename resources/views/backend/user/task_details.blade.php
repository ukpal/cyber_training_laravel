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
            <div class="col-sm-6">
                <h6 class="card-body-title">Task Details</h6>
            </div>
            <div class="col-sm-6 text-right">
                @if ($task->status=='completed')
                <button class="btn btn-primary">{{ucfirst($task->status)}}</button>
                @else
                <button class="btn btn-success">{{ucfirst($task->status)}}</button>
                @endif
                
            </div>
        </div> 
        <p class="text-center text-danger" style="border-top: 1px solid grey">Task Assigned: {{date("Y-m-d",strtotime($task->created_at))}}</p>      
        <div class="row mb-3 bg-primary">
            <div class="col-sm-8" style="border-right: 1px solid white">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold text-white">Title</label>
                            <input type="text" class="form-control" value="{{$task->title}}" disabled>
                        </div>                
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold text-white">Url</label>
                            <input type="text" class="form-control" value="{{$task->url}}" disabled>
                        </div>                
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold text-white">What to do?</label>
                            <textarea class="form-control" rows="3" disabled>{{$task->what_to_do}}</textarea>
                        </div>                
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold text-white"> Documents Shared:</label><br>
                            @foreach (json_decode($task->docs) as $item)
                                <a href="../upload/assign_task_docs/{{$item}}" class="text-white" download>{{$item}}</a> <br>
                            @endforeach
                        </div>                
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row" style="height: 100%">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold text-white">Status</label>
                            <input type="text" class="form-control" value="{{$task->status}}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        @if ($task->status=='pending')
                        <a href="" class="btn btn-secondary" data-toggle='modal' data-target='#commentModal'>Comment</a>
                        <a href="" class="btn btn-secondary" data-toggle='modal' data-target='#completeModal'>Complete Task</a>
                        @endif
                        @if ($task->status=='completed')
                        <a href="" class="btn btn-secondary" data-toggle='modal' data-target='#reopenModal'>Re-Open</a>
                        @endif
                    </div>
                </div>
            </div>
            
        </div> 
        
    </div>   

    @foreach ($progress as $item)
    @php
        if($item->role=='yoddha-member' || $item->role=='spoc'){
            $table='yoddha_team';
        }else{
            $table='users';
        }
        $data=DB::table($table)->select('fullname')->where('id',$item->user_id)->get();
    @endphp
    @if ($item->action=='reply')
    <div class="card pd-20 pd-sm-40 mt-5" style="background-color: bisque">       
        <p class="text-center text-danger" style="border-top: 1px solid grey">{{ucfirst($item->action)}} by {{$data[0]->fullname}}: {{date("Y-m-d",strtotime($task->created_at))}}</p>      
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="font-weight-bold">Observation</label>
                    <textarea class="form-control" rows="3" disabled>{{$item->observation}}</textarea>
                </div>                
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="font-weight-bold"> Documents Shared:</label><br>
                    @foreach (json_decode($item->report_files) as $doc)
                        <a href="/upload/reply_task_docs/{{$doc}}" download>{{$doc}}</a> <br>
                    @endforeach
                </div>                
            </div>
        </div> 
    </div>
    @endif
    @if ($item->action=='comment')
    <div class="card pd-20 pd-sm-40 mt-5" style="background-color:aliceblue">       
        <p class="text-center text-danger" style="border-top: 1px solid grey">{{ucfirst($item->action)}} by {{$data[0]->fullname}}: {{date("Y-m-d",strtotime($task->created_at))}}</p>      
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="font-weight-bold">Comment</label>
                    <textarea class="form-control" rows="3" disabled>{{$item->comments}}</textarea>
                </div>                
            </div>
        </div> 
    </div>
    @endif
    @if ($item->action=='change-status')
    <div class="card pd-20 pd-sm-40 mt-5" style="background-color:aliceblue">       
        <p class="text-center text-danger" style="border-top: 1px solid grey">{{ucfirst($item->action)}} by {{$data[0]->fullname}}: {{date("Y-m-d",strtotime($task->created_at))}}</p>      
        <div class="row mb-3">
            @if ($item->status)
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="font-weight-bold">Updated Status to:</label>
                    <input type="text" class="form-control" value="{{$item->status}}" disabled>
                </div>                
            </div>
            @endif
        </div> 
    </div>
    @endif
    @if ($item->action=='reopen')
    <div class="card pd-20 pd-sm-40 mt-5" style="background-color:aliceblue">       
        <p class="text-center text-danger" style="border-top: 1px solid grey">{{ucfirst($item->action)}} by {{$data[0]->fullname}}: {{date("Y-m-d",strtotime($task->created_at))}}</p>      
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="font-weight-bold">Comment</label>
                    <textarea class="form-control" rows="3" disabled>{{$item->comments}}</textarea>
                </div>                
            </div>
        </div> 
    </div>
    @endif
     
    @endforeach


    {{-- task reopen modal --}}
    <div class="modal fade" id="reopenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Re-open Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['url' => '/task-interaction', 'method' => 'post', 'class' => 'form']) }}
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{$task->id}}">     
                        <input type="hidden" name="yoddha_id" value="{{$task->yoddha_id}}">  
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">Status</label>
                                    <select class="form-control" name="status">
                                        <option selected value="">----Select----</option>
                                        <option value="pending" >Pending</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>                
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">Comments</label>
                                    <textarea class="form-control" rows="3" name="comments"></textarea>
                                </div>                
                            </div>
                                          
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- complete task modal --}}
    <div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Complete Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['url' => '/task-interaction', 'method' => 'post', 'class' => 'form']) }}
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{$task->id}}">     
                        <input type="hidden" name="yoddha_id" value="{{$task->yoddha_id}}">  
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">Status</label>
                                    <select class="form-control" name="status">
                                        <option selected value="">----Select----</option>
                                        <option value="pending" >Pending</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>                
                            </div>         
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- comment modal --}}
    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comment on Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['url' => '/task-interaction', 'method' => 'post', 'class' => 'form']) }}
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{$task->id}}">     
                        <input type="hidden" name="yoddha_id" value="{{$task->yoddha_id}}">  
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">Comments</label>
                                    <textarea class="form-control" rows="3" name="comments"></textarea>
                                </div>                
                            </div>
                                          
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
      
</div>
@stop
