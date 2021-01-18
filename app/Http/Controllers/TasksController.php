<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\Comment;
use DB;
class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        
        $this->middleware('auth');
    }
    public function index()
    {
        if(auth()->user()->hasRole('admin')){
            $tasks = Task::with('user')->sortable()->paginate(10);
     
            $projects = Project::select('name','id')->get();
            $users = User::select('email','id')->get();
            return  view('tasks.index')->with('tasks', $tasks)->with('projects', $projects)->with('users', $users);  
        }else {
            $tasks = Task::where('assignedTo', auth()->user()->id)->with('user')->sortable()->sortable()->paginate(10);
            return  view('tasks.index')->with('tasks', $tasks);  

        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->middleware(['role:admin']);
       $task = new Task;
       $task->name = $request->name;
       $task->description = $request->description;
       $task->status = $request->status;
       $task->attachment = "No attachament";
       $task->assignedTo = $request->assignedTo;
       $task->project_id = $request->project_id;
       $task->save();
       return redirect('/tasks')->with('message', 'Task created succefully!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $task_info =  Task::find($id);
        $task_info->username = User::find($task_info->assignedTo)->username;
        $task_info->project_name = Project::find($task_info->project_id)->name;

        $task_info->comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.task_id', '=', $id)
            ->select('comments.*','users.username')
            ->get();

        return $task_info;
    }
    public function updateStatus(Request $request){
       
        $task =  Task::find($request->id);
        $task->status= $request->status;
        $task->save();
        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->middleware(['role:admin']);
        $task = Task::find($id);
        $task->name = $request->name_edit;
        $task->description = $request->description_edit;
        $task->status = $request->status_edit;
        $task->attachment = "No attachament";
        $task->assignedTo = $request->assignedTo;
        $task->project_id = $request->project_id;
        $task->save();

        return redirect('/tasks')->with('message', 'Task created succefully!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
