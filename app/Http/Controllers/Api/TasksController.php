<?php

namespace App\Http\Controllers\Api;

use App\Contracts\TaskRepositoryInterface;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

class TasksController extends ApiController
{
    /**
     * @var TaskRepositoryInterface
     */
    protected $task;

    public function __construct(TaskRepositoryInterface $task)
    {
        $this->task = $task;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = TaskResource::collection($this->task->getAll());

        return $this->respondCreated("Uspesno", $tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        $data['user_id'] = $request->user_id;
        $data['isPublished'] = $request->isPublished;

        $task = $this->task->insertOrUpdate($data, null);
        $this->respondCreated("Uspesno", $task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = new TaskResource($this->task->getById($id));
        return $this->respondCreated("Uspesno", $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'caption' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        $data['user_id'] = $request->user_id;
        $data['isPublished'] = $request->isPublished;

        $task = $this->task->insertOrUpdate($data, $id);
        $this->respondCreated("Uspesno", $task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->task->delete($id);
        return $this->respondCreated("Uspesno");
    }
}
