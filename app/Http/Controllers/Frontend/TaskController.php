<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function myTasks(Request $request)
    {
        return view(
            'frontend.yoddha.my_tasks',
            [
                'module'    =>  'my-tasks',
                'tasks'   =>  DB::table('tasks')->where('yoddha_id', Session::get('admin')['sess_admin_id'])->orderBy('created_at', 'desc')->get()
            ]
        );
    }

    public function viewTask(Request $request)
    {
        return view(
            'frontend.yoddha.view_task',
            [
                'module'    =>  'view-task',
                'task'   =>  DB::table('tasks')->where('id', decrypt($request->id))->first(),
                'progress'=>DB::table('task_reply')->where('task_id', decrypt($request->id))->get()
            ]
        );
    }

    public function replyTask(Request $request)
    {
        $docs = [];
        $location = 'upload/reply_task_docs';
        //create directory
        if (!is_dir($location)) {
            @mkdir($location, 0777);
        }
        request()->validate([
            'task_docs.*' => 'mimes:doc,pdf,docx,txt,jpeg,jpg,png,csv'
        ]);
        if ($request->hasfile('task_docs')) {
            foreach ($request->file('task_docs') as $file) {
                $fileName = time() . rand(0, 1000) . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $fileName . '.' . $file->getClientOriginalExtension();
                $file->move($location, $fileName);
                array_push($docs, $fileName);
            }
        }
        $created = DB::table('task_reply')->insert([
            'task_id' => $request->id,
            'action'=>'reply',
            // 'status'=>'active',
            'observation'=>$request->observation,
            'report_files'=>json_encode($docs),
            'user_id' => Session::get('admin')['sess_admin_id'],
            'created_at' => date('Y-m-d'),
            'role' => Session::get('admin')['sess_role_name'],
        ]);
        if ($created) {
            return redirect('/cyber-yoddha/my-tasks')->with('message', 'success|Successfully Reply Submitted');
        } else {
            return redirect('/cyber-yoddha/my-tasks')->with('message', 'error|Something Went Wrong');
        }
    }
}
