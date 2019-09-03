<?php

namespace App\Repositories;

use App\Contracts\TaskRepositoryInterface;
use App\Task;

class TaskRepository implements TaskRepositoryInterface{

    /**
     * @var Task
     */
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    function getAll()
    {
        $tasks = $this->task->all()->sortByDesc('isPublished');
        return $tasks ? $tasks : null;
    }

    function getById($id)
    {
        $task = $this->task->find($id);
        return $task;
    }

    function insertOrUpdate($data, $id)
    {
        $task = $id ? $this->getById($id) : $this->task;
        $task = $this->fillTaskObject($data, $task);
        return $task->save() ? $task : null;
    }

    function fillTaskObject($data,$object)
    {
        if (isset($data['caption'])){
            $object->caption = $data['caption'];
        }
        if (isset($data['description'])){
            $object->description = $data['description'];
        }
        if (isset($data['user_id'])){
            $object->user_id = $data['user_id'];
        }
        if (isset($data['isPublished'])){
            $object->isPublished = $data['isPublished'];
        }
        if (isset($data['updated_at'])){
            $object->updated_at = $data['updated_at'];
        }
        return $object;
    }
    public function delete($id)
    {
        $this->task->whereId($id)->delete();
    }
    public function publish($id)
    {
        $task = $this->getById($id);
        $task->isPublished = true;
        $task->save();
    }
}