<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('auth');
        $task = new Task();
        return view('tasks.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('auth');
        $data = $this->validate($request, [
            'name' => 'required',
            'status_id' => 'required',
            'created_by_id' => 'required',
        ]);

        $task = new Task();
        $task->fill($data);
        $task->save();
        flash(__('tasks.messages.create'))->success();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize('auth');
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task  $task)
    {
        $this->authorize('auth');
        $data = $this->validate($request, [
            'name' => 'required',
            'status_id' => 'required',
            'created_by_id' => 'required',
        ]);

        $task->fill($data);
        $task->save();
        flash(__('tasks.messages.update'))->success();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task  $task)
    {
        $this->authorize('auth');
        if ($task) {
            $task->delete();
        }
        flash(__('tasks.messages.delete'))->success();
        return redirect()
            ->route('tasks.index');
    }
}
