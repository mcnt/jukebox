<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return Task::authUser()->paginate(20);
    }

    public function store(TaskRequest $request)
    {
        return Task::create($request->validated());
    }

    public function show(string $id)
    {
        return Task::where('id', $id)
            ->with('user')
            ->first();
    }

    public function update(TaskRequest $request, string $id)
    {
        $data = $request->validated();

        Task::where('id', $id)->update($data);

        return ['success' => 'task.updated'];
    }

    public function destroy(string $id)
    {
        Task::where('id', $id)->delete();

        return ['success' => 'task.deleted'];
    }
}
