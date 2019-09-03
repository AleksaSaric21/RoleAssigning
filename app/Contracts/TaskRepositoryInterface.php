<?php

namespace App\Contracts;

interface TaskRepositoryInterface{
    function getAll();
    function getById($taskId);
    function insertOrUpdate($data,$id);
    function delete($id);
    function publish($id);
}