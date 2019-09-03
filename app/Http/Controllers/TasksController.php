<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Contracts\TaskRepositoryInterface;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;


class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @var TaskRepositoryInterface
     */
    protected $task;


    public function __construct(TaskRepositoryInterface $task)
    {
        $this->middleware('auth')->except('index');
        $this->task = $task;
    }
    public function index(Request $request)
    {

        $tasks = $this->task->getAll();

        return view('tasks.index',[
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeWithRoles(['Moderator','Author']);
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        $data['user_id'] = auth()->user()->id;

        $request->user()->hasRole('Author') ? $data['isPublished'] = false : $data['isPublished'] = true;


        $this->task->insertOrUpdate($data,null);
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show',['task'=>$task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit',['task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {

        $data = $request->validate([
            'caption' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        $data['updated_at'] = Carbon::now();


        $this->task->insertOrUpdate($data,$task->id);

        return redirect('/tasks');
    }

    public function publish(Request $request, Task $task)
    {
        $request->user()->authorizeWithRoles('Moderator');

        $this->task->publish($task->id);

        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->task->delete($task->id);

        return redirect('/tasks');
    }
}
