<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function assignTask(Request $request)
    {
        if ($request->method() == 'POST') {
            $docs = [];
            $location = 'upload/assign_task_docs';
            //create directory
            if (!is_dir($location)) {
                @mkdir($location, 0777);
            }
            request()->validate([
                'task_docs.*' => 'mimes:doc,pdf,docx,txt,jpeg,jpg,png'
            ]);
            if ($request->hasfile('task_docs')) {
                foreach ($request->file('task_docs') as $file) {
                    $fileName = time() . rand(0, 1000) . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $fileName . '.' . $file->getClientOriginalExtension();
                    $file->move($location, $fileName);
                    array_push($docs, $fileName);
                }
            }
            $created = DB::table('tasks')->insert([
                'yoddha_id' => $request->id,
                'assigner_id' => Session::get('admin')['sess_admin_id'],
                'created_at' => date('Y-m-d'),
                'title' => $request->title,
                'url' => $request->url,
                'what_to_do' => $request->what_to_do,
                'docs' => json_encode($docs)
            ]);
            if ($created) {
                DB::table('yoddha_team')->where('id', $request->id)->update(['current_task' => 1]);
                return redirect('/yoddha-team')->with('message', 'success|Task Assigned Successfully');
            } else {
                return redirect('/yoddha-team')->with('message', 'error|Something Went Wrong');
            }
        } else {
            // 'id' can be manupulated, thats why use try-catch
            try {
                $id = decrypt($request->id);
                $yoddha = DB::table('yoddha_team')->where('id', $id)->first();
                if (empty($yoddha)) {
                    return redirect('/yoddha-team');
                }
                return view('backend.user.assign_task', [
                    'module' => 'assign task',
                    'yoddha' => $yoddha
                ]);
            } catch (\Throwable $th) {
                //throw $th;
                return redirect('/yoddha-team');
            }
        }
    }

    public function allocatedTask(Request $request)
    {
        try {
            $yoddha_id = decrypt($request->id);
            $user_id = Session::get('admin')['sess_admin_id'];
            // echo $yoddha_id.'-'.$user_id; exit();
            // echo Session::get('admin')['sess_admin_id']; exit();
            if(Session::get('admin')['sess_role_name'] == 'system-admin'){
                $tasks=DB::table('tasks')->select('tasks.*','users.fullname as assigned_by')->join('users','tasks.assigner_id','=','users.id')->where('tasks.yoddha_id',$yoddha_id)->get();
            }else{
                $tasks = DB::table('tasks')->where([['yoddha_id','=', $yoddha_id],['assigner_id','=',$user_id]])->get();
            }      
            // print_r($tasks); exit(); 
            if (empty($tasks)) {
                return redirect('/yoddha-team');
            }
            return view('backend.user.task_list', [
                'module' => 'allocated tasks',
                'tasks' => $tasks
            ]);
        } catch (\Throwable $th) {
            throw $th;
            // return redirect('/yoddha-team');
        }
    }

    public function viewTask(Request $request)
    {
        try {
            $task_id = decrypt($request->id);
            // $user_id = Session::get('admin')['sess_admin_id'];
            // echo $yoddha_id;exit();
            $task = DB::table('tasks')->where('id',$task_id)->first();
            $progress=DB::table('task_reply')->where('task_id',$task_id)->get();
            // print_r($progress);exit();
            if (empty($task)) {
                return redirect('/yoddha-team');
            }
            return view('backend.user.task_details', [
                'module' => 'task details',
                'task' => $task,
                'progress'=>$progress
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/dashboard');
        }
    }

    public function taskInteraction(Request $request)
    {
        $created = DB::table('task_reply')->insert([
            'task_id' => $request->id,
            'action'=>'comment',
            'status'=>$request->status,
            'comments'=>$request->comments,
            'user_id' => Session::get('admin')['sess_admin_id'],
            'created_at' => date('Y-m-d'),
            'role' => Session::get('admin')['sess_role_name'],
        ]);
        if ($created) {
            if(!empty($request->status)){
                DB::table('tasks')->where('id', $request->id)->update(['status' => $request->status]);
            }
            if($request->status=='completed'){
                DB::table('yoddha_team')->where('id', $request->yoddha_id)->update(['current_task' => 0]);
            }else{
                DB::table('yoddha_team')->where('id', $request->yoddha_id)->update(['current_task' => 1]);
            }           
            return redirect('/yoddha-team')->with('message', 'success| event Submitted Successfully');
        } else {
            return redirect('/yoddha-team')->with('message', 'error|Something Went Wrong');
        }
    }
}
